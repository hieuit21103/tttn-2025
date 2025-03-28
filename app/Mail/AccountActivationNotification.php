<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AccountActivationNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $registration;
    public $activationUrl;

    public function __construct($registration, $activationUrl)
    {
        $this->registration = $registration;
        $this->activationUrl = $activationUrl;
    }

    public function build()
    {
        return $this->markdown('emails.account-activation')
                    ->subject('Kích hoạt tài khoản Ký Túc Xá')
                    ->with([
                        'fullname' => $this->registration->fullname,
                        'student_code' => $this->registration->student_code,
                        'activationUrl' => $this->activationUrl
                    ]);
    }
}
