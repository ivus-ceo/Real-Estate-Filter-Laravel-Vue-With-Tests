<?php

namespace Database\Seeders;

use App\DTOs\Locations\LocationDTO;
use App\Models\Country;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $locationDTO = new LocationDTO;

        foreach ($locationDTO->countryDTOs as $countryDTO)
        {
            $country = Country::create([
                'name' => $countryDTO->name,
                'code' => $countryDTO->code,
                'continent' => $countryDTO->continent,
                'published_at' => now(),
            ]);

            $country->location()->create([
                'latitude' => $countryDTO->latitude,
                'longitude' => $countryDTO->longitude,
            ]);

            $country->slug()->create([
                'slug' => Str::slug($countryDTO->name),
            ]);
        }
    }
}
