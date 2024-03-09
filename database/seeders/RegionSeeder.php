<?php

namespace Database\Seeders;

use App\Services\Files\FileService;
use App\Models\Country;
use App\Models\Region;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (FileService::getRegions() as $region)
        {
            $model = Region::create([
                'name' => $region['name'],
                'code' => $region['state_code'],
                'country_id' => Country::where(['name' => $region['country']])->first()->id
            ]);

            $model->location()->create([
                'latitude' => $region['latitude'],
                'longitude' => $region['longitude'],
            ]);
        }
    }
}
