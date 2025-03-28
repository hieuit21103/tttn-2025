<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DuplicateRegistrationNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $registration;
    public $existingStudent;

    public function __construct($registration, $existingStudent)
    {
        $this->registration = $registration;
        $this->existingStudent = $existingStudent;
    }

    public function build()
    {
        return $this->markdown('emails.duplicate-registration')
                    ->subject('Thông Báo Đăng Ký Ký Túc Xá')
                    ->with([
                        'fullname' => $this->registration->fullname,
                        'student_code' => $this->registration->student_code,
                        'class' => $this->registration->class,
                        'existingFullname' => $this->existingStudent->fullname,
                        'existingStudentCode' => $this->existingStudent->student_code,
                        'existingClass' => $this->existingStudent->class,
                        'existingEmail' => $this->existingStudent->email
                    ]);
    }
}
