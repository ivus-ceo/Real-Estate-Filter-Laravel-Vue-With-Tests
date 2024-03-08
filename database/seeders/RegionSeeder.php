<?php

namespace Database\Seeders;

use App\Helpers\Country\CountryHelper;
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
        foreach (CountryHelper::getCollection() as $country)
        {
            $json = File::get(public_path('regions/' . Str::kebab($country['name']) . '.json'));
            $regions = json_decode($json, true);

            foreach ($regions as $region)
            {
                Region::create([
                    'name' => $region['name'],
                    'code' => $region['code'],
                    'subdivision' => $region['subdivision'] ?? null,
                    'country_id' => Country::where(['name' => $country['name']])->get()->random()->id
                ]);
            }
        }
    }
}
