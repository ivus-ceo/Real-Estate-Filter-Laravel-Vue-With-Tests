<?php

namespace Database\Seeders;

use App\DTOs\Locations\LocationDTO;
use App\Models\Region;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $locationDTO = new LocationDTO;

        foreach ($locationDTO->regionDTOs as $regionDTO)
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
                'slug' => Str::slug($regionDTO->name . '-' . $regionDTO->code),
            ]);
        }
    }
}
