<?php

namespace App\Traits\Models;

use App\Models\Selection;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

trait HasSelections
{
    public function initializeHasSelections(): void
    {
        //
    }

    public function selections(): MorphToMany
    {
        return $this->morphToMany(Selection::class, 'selectionable');
    }
}
