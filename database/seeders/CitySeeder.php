<?php

namespace Database\Seeders;

use App\Helpers\Files\FileHelper;
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
        foreach (FileHelper::getCities() as $city)
        {
            City::create([
                'name' => $city['name'],
                'latitude' => $city['latitude'],
                'longitude' => $city['longitude'],
                'region_id' => Region::where(['name' => $city['region']])->first()->id,
            ]);
        }
    }
}
