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
        $buildings = Building::factory(rand(5000, 10000))->create();

        $buildings->map(function (Building $building) {
            $location = $building->street->district->city->location;
            $coordinates = $this->coordinatesService->getRandomCoordinates(
                $location->latitude,
                $location->longitude,
                5
            );

            $building->location()->create([
                'latitude' => $coordinates['latitude'],
                'longitude' => $coordinates['longitude'],
            ]);
        });
    }
}
