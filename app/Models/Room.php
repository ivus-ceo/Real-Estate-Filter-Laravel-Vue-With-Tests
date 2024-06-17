<?php

namespace App\Models;

use App\Traits\Models\{HasBuilding, HasFeatures, HasPublishDate, HasSelections};
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Room extends Model
{
    use HasFactory, HasSelections, HasBuilding,
        HasPublishDate, HasFeatures;

    protected $fillable = [
        'name',
        'floor_id',
        'building_id',
    ];

    public function finishing(): BelongsTo
    {
        return $this->belongsTo(Finishing::class);
    }

    public function floor(): BelongsTo
    {
        return $this->belongsTo(Floor::class);
    }
}
