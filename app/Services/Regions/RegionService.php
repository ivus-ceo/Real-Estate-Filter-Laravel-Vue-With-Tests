<?php

namespace App\Services\Regions;

use App\Models\Region;
use App\Repositories\Regions\RegionRepositoryInterface;

class RegionService
{
    public function __construct(
        private readonly RegionRepositoryInterface $regionRepository
    )
    {}

    public function create(array $attributes): Region
    {
        return $this->regionRepository->create($attributes);
    }
}
