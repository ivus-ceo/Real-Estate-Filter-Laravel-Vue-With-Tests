<?php

namespace Database\Seeders;

use App\Helpers\Files\FileHelper;
use App\Models\Country;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (FileHelper::getCountries() as $country)
        {
            Country::create([
                'name' => $country['name'],
                'code' => $country['code'],
                'continent' => $country['continent'],
                'latitude' => $country['latitude'],
                'longitude' => $country['longitude'],
            ]);
        }
    }
}
