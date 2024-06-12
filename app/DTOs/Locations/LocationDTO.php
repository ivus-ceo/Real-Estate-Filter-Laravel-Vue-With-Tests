<?php

namespace App\DTOs\Locations;

use App\DTOs\BaseDTO;
use App\DTOs\Cities\CityDTO;
use App\DTOs\Countries\CountryDTO;
use App\DTOs\Regions\RegionDTO;
use App\Models\{Country, Region, City};
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Spatie\TypeScriptTransformer\Attributes\LiteralTypeScriptType;

/** @typescript */
class LocationDTO extends BaseDTO
{
    /** @var array<string, string> $countries */
    public array $countries;
    /** @var array<string, string> $regions */
    public array $regions;
    /** @var array<string, string> $cities */
    public array $cities;
    #[LiteralTypeScriptType('App.DTOs.Countries.CountryDTO[]')]
    /** @var array<CountryDTO> $countryDTOs */
    public array $countryDTOs;
    #[LiteralTypeScriptType('App.DTOs.Regions.RegionDTO[]')]
    /** @var array<RegionDTO> $regionDTOs */
    public array $regionDTOs;
    #[LiteralTypeScriptType('App.DTOs.Cities.CityDTO[]')]
    /** @var array<CityDTO> $cityDTOs */
    public array $cityDTOs;

    private Collection $locations;

    public function __construct()
    {
        $this->locations = collect(
            json_decode(File::get(public_path('countries/countries.json')), true)
        );

        $this->countries = $this->getCountries();
        $this->countryDTOs = $this->getCountryDTOs();
        $this->regions = $this->getRegions();
        $this->regionDTOs = $this->getRegionDTOs();
        $this->cities = $this->getCities();
        $this->cityDTOs = $this->getCityDTOs();
    }

    /**
     * @return array<string, string>
     */
    private function getCountries(): array
    {
        return $this->locations->transform(function (array $data) {
            $data['code'] = $data['iso3'];
            $data['continent'] = $data['region'];
            unset($data['iso3'], $data['iso2'], $data['region']);
            return $data;
        })
        ->filter(function (array $data) {
            // Filter undesired countries
            return in_array(Str::snake($data['name']), array_keys(config('countries')));
        })
        ->all();
    }

    /**
     * @return array<CountryDTO>
     */
    private function getCountryDTOs(): array
    {
        return collect($this->countries)
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

    /**
     * @return array<string, string>
     */
    private function getRegions(): array
    {
        return collect($this->countries)
            ->keyBy('name')
            ->transform(function (array $data, string $country) {
                foreach ($data['states'] as $i => $state)
                {
                    $data['states'][$i]['country'] = $country;
                }

                return $data['states'];
            })
            ->flatten(1)
            ->all();
    }

    /**
     * @return array<RegionDTO>
     */
    private function getRegionDTOs(): array
    {
        return collect($this->regions)
            ->transform(function (array $region) {
                $country = Country::firstWhere('name', $region['country']);

                if (empty($country)) return null;

                return new RegionDTO(
                    country: $country,
                    name: $region['name'],
                    code: $region['state_code'],
                    latitude: $region['latitude'],
                    longitude: $region['longitude']
                );
            })
            ->filter()
            ->all();
    }

    /**
     * @return array<string, string>
     */
    private function getCities(): array
    {
        return collect($this->regions)
            ->keyBy('name')
            ->transform(function (array $data, string $region) {
                foreach ($data['cities'] as $i => $city)
                {
                    $data['cities'][$i]['region'] = $region;
                }

                return $data['cities'];

                // Limit cities by 5 in each region
                return collect($data['cities'])->random(fn (Collection $items) => min(2, count($items)));
            })
            ->flatten(1)
            ->all();
    }

    /**
     * @return array<CityDTO>
     */
    private function getCityDTOs(): array
    {
        return collect($this->cities)
            ->transform(function (array $city) {
                $region = Region::firstWhere('name', $city['region']);

                if (empty($region)) return null;

                return new CityDTO(
                    region: $region,
                    name: $city['name'],
                    latitude: $city['latitude'],
                    longitude: $city['longitude']
                );
            })
            ->filter()
            ->all();
    }
}
