<?php

namespace App\Models;

use App\Traits\Models\HasPublishDateTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Street extends Model
{
    use HasFactory, HasPublishDateTrait;

    protected $fillable = [
        'name',
        'district_id'
    ];

    public function district(): BelongsTo
    {
        return $this->belongsTo(District::class);
    }

    public function buildings(): HasMany
    {
        return $this->hasMany(Building::class);
    }
}
