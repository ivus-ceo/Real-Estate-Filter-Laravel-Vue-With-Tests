<?php

namespace Database\Seeders;

use App\DTOs\Locations\LocationDTO;
use App\Models\City;
use App\Models\Slug;
use App\Services\Cities\CityService;
use App\Services\Locations\LocationService;
use App\Services\Slugs\SlugService;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    public function __construct(
        private readonly LocationDTO $locationDTO,
        private readonly CityService $cityService,
        private readonly LocationService $locationService,
        private readonly SlugService $slugService,
    )
    {}

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->locationDTO->cityDTOs as $cityDTO)
        {
            $city = $this->cityService->create([
                'name' => $cityDTO->name,
                'region_id' => $cityDTO->region->id,
                'published_at' => now(),
            ]);

            $this->locationService->createWithRelation($city, [
                'latitude' => $cityDTO->latitude,
                'longitude' => $cityDTO->longitude,
            ]);

            $this->slugService->createWithRelation($city, [
                'slug' => $this->slugService->createUnique($cityDTO->name),
                'published_at' => now(),
            ]);
        }
    }
}
