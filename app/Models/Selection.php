<?php

namespace App\Models;

use App\Traits\Models\HasPublishDate;
use App\Traits\Models\HasSlug;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Selection extends Model
{
    use HasPublishDate, HasSlug;

    protected $fillable = [
        'name',
        'country_id',
        'is_default',
    ];

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    public function buildings(): MorphToMany
    {
        return $this->morphedByMany(Building::class, 'selectionable');
    }

    public function rooms(): MorphToMany
    {
        return $this->morphedByMany(Room::class, 'selectionable');
    }
}
