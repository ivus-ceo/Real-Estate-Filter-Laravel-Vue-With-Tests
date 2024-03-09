<?php

namespace Database\Seeders;

use App\Models\{Building, District};
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BuildingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        District::all()->each(function (District $district) {
            $district->buildings()->createMany(
                Building::factory(rand(1, 5))->make()->toArray()
            );
        });
    }
}
