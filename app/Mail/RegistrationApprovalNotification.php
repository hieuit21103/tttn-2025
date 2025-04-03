<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RegistrationApprovalNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $registration;

    public function __construct($registration)
    {
        $this->registration = $registration;
    }

    public function build()
    {
        return $this->markdown('emails.registration-approval')
                    ->subject('Hồ sơ đăng ký ký túc xá đã được duyệt')
                    ->with([
                        'fullname' => $this->registration->fullname,
                        'student_code' => $this->registration->student_code,
                        'class' => $this->registration->class,
                        'id_number' => $this->registration->id_number,
                        'address' => $this->registration->address,
                        'activationUrl' => route('activate', $this->registration->activation_token)
                    ]);
    }
}
