<?php

namespace App\Models;

use App\Traits\Models\{HasLocation, HasPublishDate, HasSelections, HasSlug};
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Country extends Model
{
    use HasPublishDate, HasSlug, HasLocation;

    protected $fillable = [
        'name',
        'code',
        'continent',
    ];

    public function regions(): HasMany
    {
        return $this->hasMany(Region::class);
    }
}
