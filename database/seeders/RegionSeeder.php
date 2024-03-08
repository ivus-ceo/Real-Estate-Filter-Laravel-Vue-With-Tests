<?php

namespace Database\Seeders;

use App\Helpers\Files\FileHelper;
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
        foreach (FileHelper::getRegions() as $region)
        {
            Region::create([
                'name' => $region['name'],
                'code' => $region['state_code'],
                'latitude' => $region['latitude'],
                'longitude' => $region['longitude'],
                'country_id' => Country::where(['name' => $region['country']])->first()->id
            ]);
        }
    }
}
