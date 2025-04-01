<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\DormitoryRegistration;
use App\Models\Student;
use Illuminate\Support\Facades\Mail;
use App\Mail\RegistrationApprovalNotification;
use Illuminate\Support\Str;
use App\Mail\RegistrationRejectionNotification;
use App\Mail\DuplicateRegistrationNotification;
use Livewire\WithPagination;

class PendingApprovals extends Component
{
    use WithPagination;
    public $search = '';
    public $showDetailsModal = false;
    public $selectedRegistration = null;
    public $perPage = 10;

    public function render(){
        $query = DormitoryRegistration::where('status', 'pending');

        if ($this->search) {
            $query->where(function($q) {
                $q->where('student_code', 'like', '%' . $this->search . '%')
                  ->orWhere('fullname', 'like', '%' . $this->search . '%')
                  ->orWhere('class', 'like', '%' . $this->search . '%');
            });
        }

        $paginated = $query->paginate($this->perPage);

        return view('livewire.pending-approvals', [
            'registrations' => $paginated
        ]);
    }

    public function approve($id)
    {
        $registration = DormitoryRegistration::findOrFail($id);
        
        try {
            $existingStudent = Student::where('student_code', $registration->student_code)
                ->orWhere('email', $registration->email)
                ->first();

            if ($existingStudent) {
                $registration->status = 'rejected';
                $registration->save();

                Mail::to($registration->email)->send(new DuplicateRegistrationNotification($registration, $existingStudent));

                session()->flash('error', 'Học sinh đã đăng ký trước đó. Email thông báo đã được gửi đến người dùng.');
                $this->resetPage();
                return;
            }

            $existingPending = DormitoryRegistration::where('id', '!=', $id)
                ->where(function($q) use ($registration) {
                    $q->where('student_code', $registration->student_code)
                      ->orWhere('email', $registration->email);
                })
                ->where('status', 'pending')
                ->first();

            if ($existingPending) {
                session()->flash('error', 'Đã có một hồ sơ đăng ký khác đang chờ duyệt với thông tin tương tự.');
                $this->resetPage();
                return;
            }

            $registration->activation_token = Str::random(64);
            $registration->status = 'approved';
            $registration->save();
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

                Mail::to($registration->email)->send(new RegistrationApprovalNotification($registration));
                
                
                $activationUrl = route('activate', $registration->activation_token);

                $this->resetPage();

                session()->flash('success', 'Đã duyệt hồ sơ thành công. Email thông báo đã được gửi đến người dùng.');
            } catch (\Exception $e) {
                session()->flash('error', 'Có lỗi xảy ra khi duyệt hồ sơ: ' . $e->getMessage());
            }
    }

    public function reject($id)
    {
        $registration = DormitoryRegistration::findOrFail($id);
        
        try {
            $registration->status = 'rejected';
            $registration->save();

            Mail::to($registration->email)->send(new RegistrationRejectionNotification($registration));

            $this->resetPage();

            session()->flash('success', 'Đã từ chối hồ sơ thành công. Email thông báo đã được gửi đến người dùng.');
        } catch (\Exception $e) {
            session()->flash('error', 'Có lỗi xảy ra khi từ chối hồ sơ. Vui lòng thử lại.');
        }
    }

    public function showDetails($id)
    {
        $this->selectedRegistration = DormitoryRegistration::findOrFail($id);
        $this->showDetailsModal = true;
    }

    public function closeDetailsModal()
    {
        $this->showDetailsModal = false;
        $this->selectedRegistration = null;
    }

    #[On('search')]
    public function updatingSearch()
    {
        $this->resetPage();
    }
}
