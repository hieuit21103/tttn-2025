<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Student;
use App\Models\RoomType;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'room_type_id',
        'capacity',
        'current_occupancy',
        'status'
    ];

    protected $casts = [
        'capacity' => 'integer',
        'current_occupancy' => 'integer',
        'status' => 'string'
    ];

    public function students()
    {
        return $this->hasMany(Student::class);
    }

    public function roomType()
    {
        return $this->belongsTo(RoomType::class);
    }

    public function isAvailable()
    {
        return $this->status === 'available' && $this->current_occupancy < $this->capacity;
    }
}
