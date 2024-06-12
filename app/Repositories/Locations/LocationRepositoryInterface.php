<?php

namespace App\Repositories\Locations;

use App\Models\Location;
use Illuminate\Database\Eloquent\Model;

interface LocationRepositoryInterface
{
    public function createWithRelation(Model $model, array $attributes): Location;
    public function updateWithRelation(Model $model, array $attributes): bool;
}
