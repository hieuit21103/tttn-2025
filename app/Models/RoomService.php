<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoomService extends Model
{
    protected $fillable = [
        'room_id',
        'service_id',
        'price',
        'is_active',
    ];

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
