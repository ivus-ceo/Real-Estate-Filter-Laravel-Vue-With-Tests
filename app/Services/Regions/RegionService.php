<?php

namespace App\Services\Regions;

use App\DTOs\Regions\RegionDTO;
use App\Models\Country;
use App\Models\Region;
use App\Services\Countries\CountryService;

class RegionService
{
    /**
     * @return array<string, string>
     */
    public function getRegionsLocally(): array
    {
        return collect((new CountryService())->getCountriesLocally())
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
    public function getRegionDTOs(): array
    {
        return collect($this->getRegionsLocally())
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
}
