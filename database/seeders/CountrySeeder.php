<?php

namespace Database\Seeders;

use App\DTOs\Locations\LocationDTO;
use App\Services\Countries\CountryService;
use App\Services\Locations\LocationService;
use App\Services\Slugs\SlugService;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CountrySeeder extends Seeder
{
    public function __construct(
        private readonly LocationDTO $locationDTO,
        private readonly CountryService $countryService,
        private readonly LocationService $locationService,
        private readonly SlugService $slugService,
    )
    {}

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->locationDTO->countryDTOs as $countryDTO)
        {
            $country = $this->countryService->create([
                'name' => $countryDTO->name,
                'code' => $countryDTO->code,
                'continent' => $countryDTO->continent,
                'published_at' => now(),
            ]);

            $this->locationService->createWithRelation($country, [
                'latitude' => $countryDTO->latitude,
                'longitude' => $countryDTO->longitude,
            ]);

            $this->slugService->createWithRelation($country, [
                'slug' => Str::slug($countryDTO->name),
                'published_at' => now(),
            ]);
        }
    }
}
