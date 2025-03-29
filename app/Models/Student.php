<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Room;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_code',
        'fullname',
        'gender',
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
        'activated_at',
        'room_id'
    ];

    protected $casts = [
        'birthdate' => 'date',
        'registered_at' => 'datetime',
        'activated_at' => 'datetime',
        'room_id' => 'integer'
    ];

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function isActivated()
    {
        return !is_null($this->activated_at);
    }

    public function getGenderLabel()
    {
        return $this->gender === 'Nam' ? 'Nam' : 'Nữ';
    }

    public function hasRoom()
    {
        return !is_null($this->room_id);
    }
}
