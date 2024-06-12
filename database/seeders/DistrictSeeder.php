<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\{City, District};

class DistrictSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        City::all()->each(function (City $city) {
            $city->districts()->createMany(
                District::factory(rand(20, 70))->make()->toArray()
            );
        });
    }
}
