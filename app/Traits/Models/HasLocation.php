<?php

namespace App\Traits\Models;

use App\Models\Location;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

trait HasLocation
{
    public function initializeHasLocation(): void
    {
        //
    }

    public function location(): MorphOne
    {
        /** @var Model $this */
        return $this->morphOne(Location::class, 'locationable');
    }
}
