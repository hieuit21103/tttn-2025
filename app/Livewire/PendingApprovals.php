<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\DormitoryRegistration;
use Illuminate\Support\Facades\Mail;
use App\Mail\AccountActivationNotification;
use Illuminate\Support\Str;

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
        
        // Generate activation token
        $registration->activation_token = Str::random(64);
        $registration->status = 'approved';
        $registration->save();

        // Generate activation URL
        $activationUrl = route('activate', $registration->activation_token);

        // Send activation email
        Mail::to($registration->email)->send(new AccountActivationNotification($registration, $activationUrl));

        // Reload data
        $this->loadRegistrations($this->currentPage);

        session()->flash('success', 'Đã duyệt hồ sơ thành công. Email kích hoạt đã được gửi đến người dùng.');
    }

    public function reject($id)
    {
        $registration = DormitoryRegistration::findOrFail($id);
        
        $registration->status = 'rejected';
        $registration->save();

        // Reload data
        $this->loadRegistrations($this->currentPage);

        session()->flash('success', 'Đã từ chối hồ sơ thành công.');
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
