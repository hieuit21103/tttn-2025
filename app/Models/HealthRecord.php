<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HealthRecord extends Model
{
    protected $fillable = [
        'student_id',
        'date_of_birth',
        'blood_type',
        'has_chronic_disease',
        'chronic_disease_notes',
        'has_allergies',
        'allergies_notes',
        'medical_history',
        'emergency_contact_name',
        'emergency_contact_relationship',
        'emergency_contact_phone',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
