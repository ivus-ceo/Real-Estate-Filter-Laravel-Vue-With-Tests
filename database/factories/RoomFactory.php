<?php

namespace Database\Factories;

use App\DTOs\Filters\FilterDTO;
use App\Models\Finishing;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Room>
 */
class RoomFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->words(4, true),
            'roominess' => $this->faker->numberBetween(0, 6),
            'price_sale' => (rand(0, 1) == 1) ? $this->faker->numberBetween(50_000, 10_000_000) : null,
            'price_rent' => (rand(0, 1) == 1) ? $this->faker->numberBetween(500, 300_000) : null,
            'area' => $this->faker->numberBetween(7, 1000),
            'published_at' => now(),
        ];
    }
}
