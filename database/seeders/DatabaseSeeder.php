<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\{Country, User};

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->createUsers();
        $this->createCountries();
    }

    private function createUsers(): void
    {
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => '1234567890'
        ]);
    }

    private function createCountries(): void
    {
        $countries = config('countries');

        foreach ($countries as $country => $config)
        {
            Country::factory()->create([
                'name' => $country
            ]);
        }
    }
}
