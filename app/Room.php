<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    protected function floor()
    {
        return $this->belongsTo(Floor::class);
    }

    protected function building()
    {
        return $this->belongsTo(Building::class);
    }
}
