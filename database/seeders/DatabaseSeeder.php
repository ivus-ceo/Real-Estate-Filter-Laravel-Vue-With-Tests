<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\{Country, Region, User};
use Illuminate\Support\Facades\File;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => '1234567890'
        ]);

        // Locations seeders
        $this->call(CountrySeeder::class);
        $this->call(RegionSeeder::class);
        $this->call(CitySeeder::class);
        $this->call(DistrictSeeder::class);
        $this->call(StreetSeeder::class);

        // Buildings and developers
        $this->call(DeveloperSeeder::class);
        $this->call(BuildingSeeder::class);
        $this->call(FloorSeeder::class);
        $this->call(FinishingSeeder::class);
        $this->call(RoomSeeder::class);
    }
}
