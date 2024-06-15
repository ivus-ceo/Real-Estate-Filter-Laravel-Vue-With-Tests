<?php

namespace Database\Seeders;

use App\Models\Country;
use App\Services\Countries\CountryService;
use App\Services\Slugs\SlugService;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    public function __construct(
        private readonly CountryService $countryService,
        private readonly SlugService $slugService,
    )
    {}

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->countryService->getCountryDTOs() as $countryDTO)
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
                'slug' => $this->slugService->getUniqueSlug($countryDTO->name),
                'published_at' => now(),
            ]);
        }
    }
}
