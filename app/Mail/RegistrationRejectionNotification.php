<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RegistrationRejectionNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $registration;

    public function __construct($registration)
    {
        $this->registration = $registration;
    }

    public function build()
    {
        return $this->markdown('emails.registration-rejection')
                    ->subject('Hồ sơ đăng ký ký túc xá đã bị từ chối')
                    ->with([
                        'fullname' => $this->registration->fullname,
                        'student_code' => $this->registration->student_code,
                        'class' => $this->registration->class
                    ]);
    }
}
