<?php

namespace App\Models;

use App\Traits\Models\HasBuildings;
use App\Traits\Models\HasDistrict;
use App\Traits\Models\HasPublishDate;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Street extends Model
{
    use HasFactory, HasPublishDate, HasDistrict, HasBuildings;

    protected $fillable = [
        'name',
        'district_id'
    ];
}
