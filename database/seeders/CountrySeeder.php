<?php

namespace Database\Seeders;

use App\DTOs\Locations\LocationDTO;
use App\Services\Files\FileService;
use App\Models\Country;
use App\Models\Location;
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
        $locationDTO = new LocationDTO;

        foreach (FileService::getCountries() as $country)
        {
            $model = Country::create([
                'name' => $country['name'],
                'code' => $country['code'],
                'continent' => $country['continent'],
            ]);

            $model->location()->create([
                'latitude' => $country['latitude'],
                'longitude' => $country['longitude'],
            ]);
        }
    }
}
