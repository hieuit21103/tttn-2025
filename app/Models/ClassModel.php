<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Faculty;
use App\Models\Student;

class ClassModel extends Model
{
    use HasFactory;

    protected $table = 'classes';

    protected $fillable = [
        'faculty_id',
        'name',
        'total_students',
        'is_active'
    ];

    protected $casts = [
        'total_students' => 'integer',
        'is_active' => 'boolean'
    ];

    public function faculty()
    {
        return $this->belongsTo(Faculty::class, 'faculty_id', 'id');
    }

    public function students()
    {
        return $this->hasMany(Student::class, 'class_id', 'id');
    }
}
