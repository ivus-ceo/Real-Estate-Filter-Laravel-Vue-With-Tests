<?php

namespace App\DTOs\Cities;

use App\DTOs\BaseDTO;
use App\Models\Region;

/** @typescript */
class CityDTO extends BaseDTO
{
    public function __construct(
        public Region $region,
        public string $name,
        public float $latitude,
        public float $longitude
    )
    {}
}
