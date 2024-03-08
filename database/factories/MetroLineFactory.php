<?php

namespace Database\Factories;

use App\Models\MetroLine;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class MetroLineFactory extends Factory
{
    protected $model = MetroLine::class;

    public function definition()
    {
        return [
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'name' => $this->faker->name(),
        ];
    }
}
