<?php

namespace App\Repositories\Locations;

use App\Models\Location;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;

final class LocationRepository extends BaseRepository implements LocationRepositoryInterface
{
    public function __construct(
        Location $location
    )
    {
        parent::__construct($location);
    }

    public function createWithRelation(Model $model, array $attributes): Location
    {
        return $model->location()->create($attributes);
    }

    public function updateWithRelation(Model $model, array $attributes): bool
    {
        return $model->location()->create($attributes);
    }
}
