<?php

namespace Database\Seeders;

use App\DTOs\Locations\LocationDTO;
use App\Services\Locations\LocationService;
use App\Services\Regions\RegionService;
use App\Services\Slugs\SlugService;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class RegionSeeder extends Seeder
{
    public function __construct(
        private readonly LocationDTO $locationDTO,
        private readonly RegionService $regionService,
        private readonly LocationService $locationService,
        private readonly SlugService $slugService,
    )
    {}

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->locationDTO->regionDTOs as $regionDTO)
        {
            $region = $this->regionService->create([
                'name' => $regionDTO->name,
                'code' => $regionDTO->code,
                'country_id' => $regionDTO->country->id,
                'published_at' => now(),
            ]);

            $this->locationService->createWithRelation($region, [
                'latitude' => $regionDTO->latitude,
                'longitude' => $regionDTO->longitude,
            ]);

            $this->slugService->createWithRelation($region, [
                'slug' => Str::slug($regionDTO->name . '-' . $regionDTO->code),
                'published_at' => now(),
            ]);
        }
    }
}
