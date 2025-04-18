<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ViolationType extends Model
{
    protected $fillable = [
        'name',
        'description',
        'penalty',
    ];

    public function violations()
    {
        return $this->hasMany(Violation::class);
    }
}
