<?php

namespace App\DTOs\Regions;

use App\DTOs\BaseDTO;
use App\Models\Country;

/** @typescript */
class RegionDTO extends BaseDTO
{
    public function __construct(
        public Country $country,
        public string $name,
        public string $code,
        public float $latitude,
        public float $longitude
    )
    {}
}
