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
            $buildings = Building::factory(rand(1, 5))->make()->toArray();
            $location = $street->district->city->location;

            foreach ($buildings as $i => $building)
            {
                $buildings[$i]['district_id'] = $street->district_id;
                $buildings[$i]['developer_id'] = Developer::get()->random()->id;
            }

            $models = $street->buildings()->createMany($buildings);

            foreach ($models as $model)
            {
                $points = CoordinatesService::getRandomPointsWithinRadius([
                    $location->latitude,
                    $location->longitude,
                ], 5);

                $model->locations()->create([
                    'latitude' => $points[0],
                    'longitude' => $points[1],
                ]);
            }
        });
    }
}
