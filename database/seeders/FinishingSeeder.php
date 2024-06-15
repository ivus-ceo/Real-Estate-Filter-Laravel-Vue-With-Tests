<?php

namespace Database\Seeders;

use App\Models\{Building, Finishing, Floor};
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FinishingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Finishing::create([
            'name' => 'without_finishing',
        ]);

        Finishing::create([
            'name' => 'with_finishing',
        ]);

        Finishing::create([
            'name' => 'whitebox',
        ]);
    }
}
