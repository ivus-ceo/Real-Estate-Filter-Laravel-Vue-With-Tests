<?php

namespace App\Models;

use App\Traits\Models\HasBuilding;
use App\Traits\Models\HasRooms;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Floor extends Model
{
    use HasFactory, HasBuilding, HasRooms;

    protected $fillable = [
        'number',
    ];
}
