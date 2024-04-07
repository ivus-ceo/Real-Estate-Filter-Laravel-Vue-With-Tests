<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Line extends Model
{
    protected $fillable = [
        'name',
    ];

    protected function metro(): BelongsTo
    {
        return $this->belongsTo(Metro::class);
    }

    protected function stations(): HasMany
    {
        return $this->hasMany(Station::class);
    }
}
