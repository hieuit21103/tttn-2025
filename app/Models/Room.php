<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Student;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'capacity',
        'current_occupancy',
        'monthly_price',
        'status'
    ];

    protected $casts = [
        'capacity' => 'integer',
        'current_occupancy' => 'integer',
        'monthly_price' => 'decimal:2'
    ];

    public function students()
    {
        return $this->hasMany(Student::class);
    }

    public function isAvailable()
    {
        return $this->status === 'available' && $this->current_occupancy < $this->capacity;
    }
}
