<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_code',
        'fullname',
        'class',
        'birthdate',
        'id_number',
        'personal_phone',
        'family_phone',
        'address',
        'email',
        'id_front_path',
        'id_back_path',
        'registered_at',
        'activated_at'
    ];

    protected $casts = [
        'birthdate' => 'date',
        'registered_at' => 'datetime',
        'activated_at' => 'datetime'
    ];
}
