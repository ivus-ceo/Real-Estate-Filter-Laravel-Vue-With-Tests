<?php

namespace Database\Seeders;

use App\Models\{Floor, Room};
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Floor::all()->each(function (Floor $floor) {
            $rooms = Room::factory(rand(1, 4))->make()->toArray();

            foreach ($rooms as $i => $room)
            {
                $rooms[$i]['building_id'] = $floor->building_id;
            }

            $floor->rooms()->createMany($rooms);
        });
    }
}
