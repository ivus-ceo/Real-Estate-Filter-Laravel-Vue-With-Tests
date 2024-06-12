<?php

namespace App\Repositories\Cities;

use App\Models\City;
use App\Repositories\BaseRepository;

final class CityRepository extends BaseRepository implements CityRepositoryInterface
{
    public function __construct(
        City $city
    )
    {
        parent::__construct($city);
    }
}
