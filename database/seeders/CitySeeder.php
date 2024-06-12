<?php

namespace Database\Seeders;

use App\DTOs\Locations\LocationDTO;
use App\Models\City;
use App\Models\Slug;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $locationDTO = new LocationDTO;

        foreach ($locationDTO->cityDTOs as $cityDTO)
        {
            $city = City::create([
                'name' => $cityDTO->name,
                'region_id' => $cityDTO->region->id,
                'published_at' => now(),
            ]);

            $city->location()->create([
                'latitude' => $cityDTO->latitude,
                'longitude' => $cityDTO->longitude,
            ]);

            $slug = Str::slug($cityDTO->name);

            if (Slug::where(['slug' => $slug])->exists()) {
                $slug .= '-' . uniqid();
            }

            $city->slug()->create([
                'slug' => $slug,
            ]);
        }
    }
}
