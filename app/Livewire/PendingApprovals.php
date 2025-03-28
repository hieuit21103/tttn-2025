<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\DormitoryRegistration;
use App\Models\Student;
use Illuminate\Support\Facades\Mail;
use App\Mail\AccountActivationNotification;
use App\Mail\RegistrationApprovalNotification;
use Illuminate\Support\Str;
use App\Mail\RegistrationRejectionNotification;
use App\Mail\DuplicateRegistrationNotification;

class PendingApprovals extends Component
{
    public $search = '';
    public $registrations = [];
    public $pagination = [];
    public $currentPage = 1;

    public function mount()
    {
        $this->loadRegistrations();
    }

    public function loadRegistrations($page = 1)
    {
        $query = DormitoryRegistration::where('status', 'pending');

        if ($this->search) {
            $query->where(function($q) {
                $q->where('student_code', 'like', '%' . $this->search . '%')
                  ->orWhere('fullname', 'like', '%' . $this->search . '%')
                  ->orWhere('class', 'like', '%' . $this->search . '%');
            });
        }

        $paginated = $query->paginate(10, ['*'], 'page', $page);
        
        // Store the data and pagination info separately
        $this->registrations = $paginated->items();
        $this->pagination = [
            'current_page' => $paginated->currentPage(),
            'last_page' => $paginated->lastPage(),
            'total' => $paginated->total(),
            'per_page' => $paginated->perPage(),
            'from' => $paginated->firstItem(),
            'to' => $paginated->lastItem()
        ];
        $this->currentPage = $page;
    }

    public function approve($id)
    {
        $registration = DormitoryRegistration::findOrFail($id);
        
        try {
            // Check if student already exists in students table
            $existingStudent = Student::where('student_code', $registration->student_code)
                ->orWhere('email', $registration->email)
                ->first();

            if ($existingStudent) {
                $registration->status = 'rejected';
                $registration->save();

                // Send duplicate notification
                Mail::to($registration->email)->send(new DuplicateRegistrationNotification($registration, $existingStudent));

                session()->flash('error', 'Học sinh đã đăng ký trước đó. Email thông báo đã được gửi đến người dùng.');
                $this->loadRegistrations($this->currentPage);
                return;
            }

            // Check if there's another pending registration
            $existingPending = DormitoryRegistration::where('id', '!=', $id)
                ->where(function($q) use ($registration) {
                    $q->where('student_code', $registration->student_code)
                      ->orWhere('email', $registration->email);
                })
                ->where('status', 'pending')
                ->first();

            if ($existingPending) {
                session()->flash('error', 'Đã có một hồ sơ đăng ký khác đang chờ duyệt với thông tin tương tự.');
                $this->loadRegistrations($this->currentPage);
                return;
            }

            // Generate activation token
            $registration->activation_token = Str::random(64);
            $registration->status = 'approved';
            $registration->save();

            // Add to students table
            Student::create([
                'student_code' => $registration->student_code,
                'fullname' => $registration->fullname,
                'class' => $registration->class,
                'birthdate' => $registration->birthdate,
                'id_number' => $registration->id_number,
                'personal_phone' => $registration->personal_phone,
                'family_phone' => $registration->family_phone,
                'address' => $registration->address,
                'email' => $registration->email,
                'id_front_path' => $registration->id_front_path,
                'id_back_path' => $registration->id_back_path,
                'registered_at' => $registration->created_at,
                'activated_at' => now()
            ]);

            // Generate activation URL
            $activationUrl = route('activate', $registration->activation_token);

            // Send activation email
            Mail::to($registration->email)->send(new AccountActivationNotification($registration, $activationUrl));

            // Send approval notification
            Mail::to($registration->email)->send(new RegistrationApprovalNotification($registration));

            // Reload data
            $this->loadRegistrations($this->currentPage);

            session()->flash('success', 'Đã duyệt hồ sơ thành công. Email kích hoạt và thông báo đã được gửi đến người dùng.');
        } catch (\Exception $e) {
            session()->flash('error', 'Có lỗi xảy ra khi duyệt hồ sơ. Vui lòng thử lại.');
        }
    }

    public function reject($id)
    {
        $registration = DormitoryRegistration::findOrFail($id);
        
        try {
            $registration->status = 'rejected';
            $registration->save();

            // Send rejection notification
            Mail::to($registration->email)->send(new RegistrationRejectionNotification($registration));

            // Reload data
            if ($this->currentPage > 1 && DormitoryRegistration::where('status', 'pending')->where('id', '>', $id)->count() == 0) {
                $this->loadRegistrations($this->currentPage - 1);
            } else {
                $this->loadRegistrations($this->currentPage);
            }

            session()->flash('success', 'Đã từ chối hồ sơ thành công. Email thông báo đã được gửi đến người dùng.');
        } catch (\Exception $e) {
            session()->flash('error', 'Có lỗi xảy ra khi từ chối hồ sơ. Vui lòng thử lại.');
        }
    }

    public function updatingSearch()
    {
        $this->loadRegistrations(1);
    }

    public function render()
    {
        return view('livewire.pending-approvals');
    }
}
