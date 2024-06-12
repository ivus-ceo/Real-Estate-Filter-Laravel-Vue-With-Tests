<?php

namespace Database\Seeders;

use App\Services\Coordinates\CoordinatesService;
use App\Models\{Building, Developer, District, Street};
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BuildingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Street::all()->each(function (Street $street) {
            $buildings = Building::factory(rand(5, 50))->make()->toArray();
            $location = $street->district->city->location;
            $buildings = $street->buildings()->createMany($buildings);

            foreach ($buildings as $building)
            {
                $points = CoordinatesService::getRandomPointsWithinRadius([
                    $location->latitude,
                    $location->longitude,
                ], 5);

                $model->location()->create([
                    'latitude' => $points[0],
                    'longitude' => $points[1],
                ]);
            }
        });
    }
}
