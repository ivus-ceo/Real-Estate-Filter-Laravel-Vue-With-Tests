<?php

namespace App\DTOs\Countries;

use App\DTOs\BaseDTO;

/** @typescript */
class CountryDTO extends BaseDTO
{
    public function __construct(
        public string $name,
        public string $code,
        public string $continent,
        public float $latitude,
        public float $longitude
    )
    {}
}
