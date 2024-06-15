<?php

namespace Database\Seeders;

use App\Models\Region;
use App\Services\Regions\RegionService;
use App\Services\Slugs\SlugService;
use Illuminate\Database\Seeder;

class RegionSeeder extends Seeder
{
    public function __construct(
        private readonly RegionService $regionService,
        private readonly SlugService $slugService,
    )
    {}

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->regionService->getRegionDTOs() as $regionDTO)
        {
            $region = Region::create([
                'name' => $regionDTO->name,
                'code' => $regionDTO->code,
                'country_id' => $regionDTO->country->id,
                'published_at' => now(),
            ]);

            $region->location()->create([
                'latitude' => $regionDTO->latitude,
                'longitude' => $regionDTO->longitude,
            ]);

            $region->slug()->create([
                'slug' => $this->slugService->getUniqueSlug($regionDTO->name . '-' . $regionDTO->code),
                'published_at' => now(),
            ]);
        }
    }
}
