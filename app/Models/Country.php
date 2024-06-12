<?php

namespace App\Models;

use App\Traits\Models\{HasLocationTrait, HasPublishDateTrait, HasSlugTrait};
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Country extends Model
{
    use HasPublishDateTrait, HasSlugTrait, HasLocationTrait;

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
