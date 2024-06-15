<?php

namespace App\Models;

use App\Traits\Models\HasBuildings;
use App\Traits\Models\HasPublishDate;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class District extends Model
{
    use HasFactory, HasPublishDate, HasBuildings;

    protected $fillable = [
        'name',
        'city_id'
    ];

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    public function streets(): HasMany
    {
        return $this->hasMany(Street::class);
    }
}
