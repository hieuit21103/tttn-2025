<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Room;
use App\Models\Service;

class ServiceInvoice extends Model
{
    protected $fillable = [
        'room_id',
        'amount',
        'month',
        'paid',
        'paid_at',
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
