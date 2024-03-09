<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Country extends Model
{
    protected $fillable = [
        'name',
        'code',
        'continent',
    ];

    public function regions(): HasMany
    {
        return $this->hasMany(Region::class);
    }

    public function location(): MorphOne
    {
        return $this->morphOne(Location::class, 'locationable');
    }
}
