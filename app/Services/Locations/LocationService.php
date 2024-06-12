<?php

namespace App\Services\Locations;

use App\Exceptions\Locations\LocationRelationshipDoesNotExistException;
use App\Models\Location;
use App\Repositories\Locations\LocationRepositoryInterface;
use App\Traits\Models\HasLocationTrait;
use Illuminate\Database\Eloquent\Model;
use ReflectionClass;
use ReflectionException;

class LocationService
{
    public function __construct(
        private readonly LocationRepositoryInterface $locationRepository
    )
    {}

    /**
     * @throws ReflectionException
     * @throws LocationRelationshipDoesNotExistException
     */
    public function createWithRelation(Model $model, array $attributes): Location
    {
        $this->hasLocationTrait($model);
        return $this->locationRepository->createWithRelation($model, $attributes);
    }

    /**
     * @throws ReflectionException
     * @throws LocationRelationshipDoesNotExistException
     */
    public function updateWithRelation(Model $model, array $attributes): bool
    {
        $this->hasLocationTrait($model);
        return $this->locationRepository->updateWithRelation($model, $attributes);
    }

    /**
     * @param Model $model
     * @return bool
     * @throws LocationRelationshipDoesNotExistException
     * @throws ReflectionException
     */
    private function hasLocationTrait(Model $model): bool
    {
        $modelClass = get_class($model);
        $hasSlugTrait = in_array(
            HasLocationTrait::class,
            array_keys((new ReflectionClass($modelClass))->getTraits())
        );

        if (!$hasSlugTrait) {
            throw new LocationRelationshipDoesNotExistException(
                'Location relationship does not exist on ' . $modelClass . ' use ' . HasLocationTrait::class . ' trait'
            );
        }

        return true;
    }
}
