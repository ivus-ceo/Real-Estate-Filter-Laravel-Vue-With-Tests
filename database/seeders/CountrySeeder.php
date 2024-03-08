<?php

namespace Database\Seeders;

use App\Helpers\Country\CountryHelper;
use App\Models\Country;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (CountryHelper::getCollection() as $country)
        {
            Country::create([
                'name' => $country['name'],
                'code' => $country['code'],
                'continent' => $country['continent']
            ]);
        }
    }
}
