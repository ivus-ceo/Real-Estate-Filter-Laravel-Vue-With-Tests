<?php

namespace App\Repositories\Countries;

use App\Models\Country;
use App\Repositories\BaseRepository;

final class CountryRepository extends BaseRepository implements CountryRepositoryInterface
{
    public function __construct(
        Country $country
    )
    {
        parent::__construct($country);
    }
}
