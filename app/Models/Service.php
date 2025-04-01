<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'name',
        'unit',
        'price_per_unit',
        'type',
        'previous_reading',
        'current_reading'
    ];

    protected $casts = [
        'price_per_unit' => 'decimal:2',
        'previous_reading' => 'decimal:2',
        'current_reading' => 'decimal:2',
    ];

    public function calculatePrice()
    {
        if ($this->type === 'fixed') {
            return $this->price_per_unit;
        }

        $consumption = $this->current_reading - $this->previous_reading;
        
        if ($consumption <= 0) {
            return $this->price_per_unit;
        }

        return $consumption * $this->price_per_unit;
    }

    public function rooms()
    {
        return $this->belongsToMany(Room::class, 'room_service')
            ->withPivot('price', 'description', 'is_active')
            ->withTimestamps();
    }
}
