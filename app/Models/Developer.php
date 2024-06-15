<?php

namespace App\Models;

use App\Traits\Models\HasBuildings;
use App\Traits\Models\HasPublishDate;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Developer extends Model
{
    use HasFactory, HasPublishDate, HasBuildings;

    protected $fillable = [
        'name',
    ];
}
