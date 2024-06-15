<?php

namespace Database\Seeders;

use App\Services\Coordinates\CoordinatesService;
use App\Models\{Building, Street};
use Illuminate\Database\Seeder;

class BuildingSeeder extends Seeder
{
    public function __construct(
        private readonly CoordinatesService $coordinatesService
    )
    {}

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Street::all()->each(function (Street $street) {
            $buildings = Building::factory(rand(1, 3))->make()->toArray();
            $location = $street->district->city->location;
            $buildings = $street->buildings()->createMany($buildings);

            foreach ($buildings as $building)
            {
                $coordinates = $this->coordinatesService->getRandomCoordinates(
                    $location->latitude,
                    $location->longitude,
                    5
                );

                $building->location()->create([
                    'latitude' => $coordinates['latitude'],
                    'longitude' => $coordinates['longitude'],
                ]);
            }
        });
    }
}
