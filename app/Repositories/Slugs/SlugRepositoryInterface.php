<?php

namespace App\Repositories\Slugs;

use App\Models\Slug;
use Illuminate\Database\Eloquent\Model;

interface SlugRepositoryInterface
{
    public function exists(string $slug): bool;
    public function createWithRelation(Model $model, array $attributes): Slug;
    public function updateWithRelation(Model $model, array $attributes): bool;
}
