<?php

namespace Database\Seeders;

use App\Models\Country;
use App\Models\Developer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DeveloperSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Country::all()->each(function (Country $country) {
            Developer::factory(rand(10, 15))->create();
        });
    }
}
