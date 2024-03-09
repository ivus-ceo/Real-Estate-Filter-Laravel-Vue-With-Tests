<?php

namespace Database\Factories;

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
        $districtId = $this->faker->numberBetween(District::min('id'), District::max('id'));
        $district = District::find($districtId);

        return [
            'name' => $this->faker->streetName,
            'latitude' => $this->faker->latitude($district->city->latitude - 1, $district->city->latitude + 1),
            'longitude' => $this->faker->longitude($district->city->longitude - 1, $district->city->longitude + 1),
            'street_id' => $this->faker->numberBetween(Street::min('id'), Street::max('id')),
            'developer_id' => $this->faker->numberBetween(Developer::min('id'), Developer::max('id')),
            'district_id' => $districtId,
        ];
    }
}
