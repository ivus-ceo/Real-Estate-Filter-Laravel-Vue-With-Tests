<?php

namespace Database\Seeders;

use App\Services\Files\FileService;
use App\Models\City;
use App\Models\Region;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (FileService::getCities() as $city)
        {
            $regionId = Region::where(['name' => $city['region']])->first()->id ?? null;

            $model = City::create([
                'name' => $city['name'],
                'region_id' => $regionId,
            ]);

            $model->location()->create([
                'latitude' => $city['latitude'],
                'longitude' => $city['longitude'],
            ]);
        }
    }
}
