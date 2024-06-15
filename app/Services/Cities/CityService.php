<?php

namespace App\Services\Cities;

use App\DTOs\Cities\CityDTO;
use App\Models\City;
use App\Models\Region;
use App\Services\Regions\RegionService;
use Illuminate\Support\Collection;

class CityService
{
    /**
     * @return array<string, string>
     */
    public function getCitiesLocally(): array
    {
        return collect((new RegionService())->getRegionsLocally())
            ->keyBy('name')
            ->transform(function (array $data, string $region) {
                foreach ($data['cities'] as $i => $city)
                {
                    $data['cities'][$i]['region'] = $region;
                }

                // Limit cities by min 5 in each region
                return collect($data['cities'])->random(fn (Collection $items) => min(5, count($items)));
            })
            ->flatten(1)
            ->all();
    }

    /**
     * @return array<CityDTO>
     */
    public function getCityDTOs(): array
    {
        return collect($this->getCitiesLocally())
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
