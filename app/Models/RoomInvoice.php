<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Student;
use App\Models\Room;

class RoomInvoice extends Model
{
    protected $fillable = [
        'student_id',
        'room_id',
        'amount',
        'month',
        'paid',
        'paid_at',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}
