<?php

namespace App\Traits\Models;

use App\Models\Room;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait HasRooms
{
    public function initializeHasRooms(): void
    {
        //
    }

    public function rooms(): HasMany
    {
        return $this->hasMany(Room::class);
    }
}
