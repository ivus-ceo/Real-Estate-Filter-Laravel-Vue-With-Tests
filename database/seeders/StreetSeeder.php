<?php

namespace Database\Seeders;

use App\Models\{Building, District, Street};
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StreetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        District::all()->each(function (District $district) {
            $district->streets()->createMany(
                Street::factory(rand(5, 10))->make()->toArray()
            );
        });
    }
}
