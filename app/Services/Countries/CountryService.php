<?php

namespace App\Services\Countries;

use App\DTOs\Countries\CountryDTO;
use Illuminate\Support\Facades\File;

class CountryService
{
    /**
     * @return array<string, string>
     */
    public function getCountriesLocally(): array
    {
        $locations = collect(
            json_decode(File::get(public_path('countries/countries.json')), true)
        );

        return $locations->transform(function (array $data) {
            $data['code'] = $data['iso3'];
            $data['continent'] = $data['region'];
            unset($data['iso3'], $data['iso2'], $data['region']);
            return $data;
        })
        ->filter(function (array $data) {
            // Filter undesired countries
            return in_array($data['name'], config('locations.countries'));
        })
        ->all();
    }

    /**
     * @return array<CountryDTO>
     */
    public function getCountryDTOs(): array
    {
        return collect($this->getCountriesLocally())
            ->transform(function (array $country) {
                return new CountryDTO(
                    name: $country['name'],
                    code: $country['code'],
                    continent: $country['continent'],
                    latitude: $country['latitude'],
                    longitude: $country['longitude']
                );
            })
            ->all();
    }
}
