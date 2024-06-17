<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
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
                District::factory(rand(1, 3))->make()->toArray()
            );
        });
    }
}
