<?php

namespace Database\Seeders;

use App\Models\City;
use App\Services\Cities\CityService;
use App\Services\Slugs\SlugService;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    public function __construct(
        private readonly CityService $cityService,
        private readonly SlugService $slugService,
    )
    {}

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->cityService->getCityDTOs() as $cityDTO)
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

            $city->slug()->create([
                'slug' => $this->slugService->getUniqueSlug($cityDTO->name),
                'published_at' => now(),
            ]);
        }
    }
}
