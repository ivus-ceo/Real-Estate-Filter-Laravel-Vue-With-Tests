<?php

namespace App\Helpers\Country;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class CountryHelper
{
    public static function getCollection(): Collection
    {
        $countries = array_keys(config('countries'));
        $json = File::get(public_path('countries/countries.json'));
        $list = json_decode($json, true);

        return collect($list)->filter(function (array $data) use ($countries) {
            return in_array(Str::kebab($data['name']), $countries);
        });
    }
}
