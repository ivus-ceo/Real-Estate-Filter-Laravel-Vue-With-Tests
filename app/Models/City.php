<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class City extends Model
{
    protected $fillable = [
        'name',
        'latitude',
        'longitude',
        'region_id'
    ];

    public function region(): BelongsTo
    {
        return $this->belongsTo(Region::class);
    }
}
