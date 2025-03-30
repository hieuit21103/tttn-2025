<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RoomType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'capacity',
        'monthly_price'
    ];

    protected $casts = [
        'capacity' => 'integer',
        'monthly_price' => 'decimal:2'
    ];

    public function rooms()
    {
        return $this->hasMany(Room::class,'room_type_id','id');
    }

    public function getRoomsCountAttribute()
    {
        return $this->rooms()->count();
    }
}
