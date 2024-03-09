<?php

namespace App\Helpers\Files;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;

class FileHelper
{
    public static function getCountries(): Collection
    {
        return self::getJsonDecodedContent('countries/countries.json')
            ->transform(function (array $data) {
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

    public static function getRegions(): Collection
    {
        return self::getCountries()
            ->keyBy('name')
            ->transform(function (array $data, string $country) {
                foreach ($data['states'] as $i => $state)
                {
                    $data['states'][$i]['country'] = $country;
                }

                return $data['states'];
            })
            ->flatten(1);
    }

    public static function getCities(): Collection
    {
        return self::getRegions()
            ->keyBy('name')
            ->transform(function (array $data, string $region) {
                foreach ($data['cities'] as $i => $city)
                {
                    $data['cities'][$i]['region'] = $region;
                }

                // Limit cities by 3 in each region
                return collect($data['cities'])->random(fn (Collection $items) => min(3, count($items)));
            })
            ->flatten(1);
    }

    private static function getJsonDecodedContent(string $path, bool $associative = true): ?Collection
    {
        return collect(json_decode(File::get(public_path($path)), $associative));
    }
}
