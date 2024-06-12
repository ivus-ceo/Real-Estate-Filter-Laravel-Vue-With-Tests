<?php

namespace App\Services\Cities;

use App\Models\City;
use App\Repositories\Cities\CityRepositoryInterface;

class CityService
{
    public function __construct(
        private readonly CityRepositoryInterface $cityRepository
    )
    {}

    public function create(array $attributes): City
    {
        return $this->cityRepository->create($attributes);
    }
}
