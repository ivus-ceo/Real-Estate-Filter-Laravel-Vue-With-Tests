<?php

namespace App\Services\Countries;

use App\Models\Country;
use App\Repositories\Countries\CountryRepositoryInterface;

class CountryService
{
    public function __construct(
        private readonly CountryRepositoryInterface $countryRepository
    )
    {}

    public function create(array $attributes): Country
    {
        return $this->countryRepository->create($attributes);
    }
}
