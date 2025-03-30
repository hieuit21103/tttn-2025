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
        'monthly_price',
        'current_occupancy',
        'status'
    ];

    protected $casts = [
        'capacity' => 'integer',
        'current_occupancy' => 'integer',
        'monthly_price' => 'integer',
        'status' => 'string'
    ];

    public function students()
    {
        return $this->hasMany(Student::class,'room_id','id');
    }

    public function roomType()
    {
        return $this->belongsTo(RoomType::class,'room_type_id','id');
    }

    public function isAvailable()
    {
        return $this->status === 'available' && $this->current_occupancy < $this->capacity;
    }
}
