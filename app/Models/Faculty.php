<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ClassModel;
use App\Models\Student;

class Faculty extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];

    public function classes()
    {
        return $this->hasMany(ClassModel::class, 'faculty_id', 'id');
    }

    public function students()
    {
        return $this->hasMany(Student::class, 'faculty_id', 'id');
    }
}
