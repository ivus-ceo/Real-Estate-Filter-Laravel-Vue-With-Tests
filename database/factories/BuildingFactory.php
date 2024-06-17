<?php

namespace Database\Factories;

use App\Models\Country;
use App\Models\Developer;
use App\Models\District;
use App\Models\Street;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Building>
 */
class BuildingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->streetName,
            'developer_id' => $this->faker->numberBetween(Developer::min('id'), Developer::max('id')),
            'street_id' => $this->faker->numberBetween(Street::min('id'), Street::max('id')),
            'published_at' => now(),
        ];
    }
}
