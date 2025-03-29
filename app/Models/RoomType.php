<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RoomType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'monthly_price'
    ];

    protected $casts = [
        'monthly_price' => 'decimal:2'
    ];

    public function rooms()
    {
        return $this->hasMany(Room::class);
    }
}
