<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DormitoryRegistration extends Model
{
    protected $table = 'dormitory_registrations';
    
    protected $fillable = [
        'student_code',
        'fullname',
        'gender',
        'birthdate',
        'class',
        'id_number',
        'personal_phone',
        'family_phone',
        'email',
        'address',
        'id_front_path',
        'id_back_path',
        'status',
        'activation_token'
    ];
    
    protected $casts = [
        'birthdate' => 'date',
        'status' => 'string'
    ];

    protected $attributes = [
        'status' => 'pending'
    ];
}
