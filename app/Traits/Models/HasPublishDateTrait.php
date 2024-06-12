<?php

namespace App\Traits\Models;

use Illuminate\Database\Eloquent\Builder;

/**
 * @method static published()
 */
trait HasPublishDateTrait
{
    public function initializeHasPublishDateTrait(): void
    {
        $this->fillable[] = 'published_at';
    }

    public function scopePublished(Builder $query): void
    {
        $query->whereNotNull('published_at');
    }
}
