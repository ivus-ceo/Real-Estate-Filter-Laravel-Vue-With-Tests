<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Building extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'street_id',
        'developer_id',
        'district_id',
    ];

    public function street(): BelongsTo
    {
        return $this->belongsTo(Street::class);
    }

    public function developer(): BelongsTo
    {
        return $this->belongsTo(Developer::class);
    }

    public function district(): BelongsTo
    {
        return $this->belongsTo(Developer::class);
    }

    public function floors(): HasMany
    {
        return $this->hasMany(Floor::class);
    }
}
