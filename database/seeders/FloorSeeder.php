<?php

namespace Database\Seeders;

use App\Models\{Building, Floor};
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FloorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Building::all()->each(function (Building $building) {
            $building->floors()->createMany(
                Floor::factory(rand(1, 5))
                    ->sequence(fn ($sequence) => ['number' => $sequence->index + 1])
                    ->make()
                    ->toArray()
            );
        });
    }
}
