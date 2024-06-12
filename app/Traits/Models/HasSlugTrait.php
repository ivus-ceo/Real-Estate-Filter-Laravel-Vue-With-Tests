<?php

namespace App\Traits\Models;

use App\Models\Slug;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

trait HasSlugTrait
{
    public function initializeHasSlugTrait(): void
    {
        //
    }

    public function slug(): MorphOne
    {
        /** @var Model $this */
        return $this->morphOne(Slug::class, 'slugable');
    }
}
