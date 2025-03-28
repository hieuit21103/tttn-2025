<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DormitoryRegistrationNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $registration;

    public function __construct($registration)
    {
        $this->registration = $registration;
    }

    public function build()
    {
        return $this->markdown('emails.dormitory-registration')
                    ->subject('Xác nhận đăng ký Ký Túc Xá')
                    ->with([
                        'fullname' => $this->registration->fullname,
                        'student_code' => $this->registration->student_code,
                        'class' => $this->registration->class,
                        'id_number' => $this->registration->id_number,
                        'address' => $this->registration->address
                    ]);
    }
}
