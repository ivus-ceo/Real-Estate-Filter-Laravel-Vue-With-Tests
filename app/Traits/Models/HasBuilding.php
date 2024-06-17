<?php

namespace App\Traits\Models;

use App\Models\Building;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait HasBuilding
{
    public function initializeHasBuilding(): void
    {
        //
    }

    public function building(): BelongsTo
    {
        return $this->belongsTo(Building::class);
    }
}
