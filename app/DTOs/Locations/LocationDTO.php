<?php

namespace App\DTOs\Locations;

use App\DTOs\BaseDTO;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;

class LocationDTO extends BaseDTO
{
    public array $countries;
    public array $regions;
    public array $cities;

    private Collection $locations;

    public function __construct()
    {
        $this->locations = collect(
            json_decode(File::get(public_path('countries/countries.json')), true)
        );

        $this->countries = $this->getCountries();
    }

    private function getCountries(): array
    {
        return $this->locations->transform(function (array $data) {
            $data['code'] = $data['iso2'];
            $data['continent'] = $data['region'];
            unset($data['iso3'], $data['iso2'], $data['region']);
            return $data;
        })
        ->filter(function (array $data) {
            // Filter unwanted countries
            return in_array(\Str::kebab($data['name']), array_keys(config('countries')));
        });
    }
}
