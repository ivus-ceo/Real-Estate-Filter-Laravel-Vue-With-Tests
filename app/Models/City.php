<?php

namespace App\Models;

use App\Traits\Models\{HasLocationTrait, HasPublishDateTrait, HasSlugTrait};
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class City extends Model
{
    use HasPublishDateTrait, HasSlugTrait, HasLocationTrait;

    protected $fillable = [
        'name',
        'region_id'
    ];

    public function region(): BelongsTo
    {
        return $this->belongsTo(Region::class);
    }

    public function districts(): HasMany
    {
        return $this->hasMany(District::class);
    }
}
