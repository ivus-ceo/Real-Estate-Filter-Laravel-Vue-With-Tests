<?php

namespace Database\Seeders;

use App\Services\Slugs\SlugService;
use App\Models\{Building, Country, Room, Selection};
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;

class SelectionSeeder extends Seeder
{
    public function __construct(
        private readonly SlugService $slugService
    )
    {}

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $countries = Country::with([
            'regions:id,country_id',
            'regions.cities:id,region_id',
            'regions.cities.districts:id,city_id',
            'regions.cities.districts.streets:id,district_id',
            'regions.cities.districts.streets.buildings',
            'regions.cities.districts.streets.buildings.rooms',
        ])->get();

        $countries->transform(function ($country) {
            $buildings = $country->regions->map(function ($region) {
                return $region->cities->map(function ($city) {
                    return $city->districts->map(function ($district) {
                        return $district->streets->map(function ($street) {
                            return $street->buildings;
                        });
                    });
                });
            })
            ->flatten();

            return [
                'country' => $country,
                'buildings' => $buildings,
            ];
        })
        ->map(function ($data) {
            $country = $data['country'];
            $buildings = $data['buildings']->pluck('id');
            $rooms = $data['buildings']->map(function ($building) {
                return $building->rooms;
            })->flatten()->pluck('id');

            $buildingsSelection = Selection::create([
                'name' => 'All buildings in ' . $country->name,
                'country_id' => $country->id,
                'is_default' => true,
                'published_at' => now()
            ]);

            $buildingsSelection->buildings()->sync($buildings);
            $buildingsSelection->slug()->create([
                'slug' => $this->slugService->getUniqueSlug('buildings'),
                'published_at' => now(),
            ]);

            $roomsSelection = Selection::create([
                'name' => 'All rooms in ' . $country->name,
                'country_id' => $country->id,
                'is_default' => true,
                'published_at' => now()
            ]);

            $roomsSelection->rooms()->sync($rooms);
            $roomsSelection->slug()->create([
                'slug' => $this->slugService->getUniqueSlug('rooms'),
                'published_at' => now(),
            ]);
        });
    }
}
