<?php

namespace App\Traits\Models;

use App\Models\District;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait HasDistrict
{
    public function initializeHasDistrict(): void
    {
        //
    }

    public function district(): BelongsTo
    {
        return $this->belongsTo(District::class);
    }
}
