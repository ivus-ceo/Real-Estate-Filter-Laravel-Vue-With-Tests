<?php

namespace App\Traits\Models;

use App\Models\Slug;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

trait HasSlug
{
    public function initializeHasSlug(): void
    {
        //
    }

    public function slug(): MorphOne
    {
        /** @var Model $this */
        return $this->morphOne(Slug::class, 'slugable');
    }
}
