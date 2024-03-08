<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuildingFloor extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    protected function building()
    {
        return $this->belongsTo(Building::class);
    }
}
