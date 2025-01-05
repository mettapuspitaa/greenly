<?php

namespace Database\Factories;

use App\Models\Skor;
use Illuminate\Database\Eloquent\Factories\Factory;

class SkorFactory extends Factory
{
    protected $model = Skor::class;

    public function definition()
    {
        return [
            'emission_km' => $this->faker->randomFloat(2, 0, 100),
            'emission_kwh' => $this->faker->randomFloat(2, 0, 100),
            'emission_food' => $this->faker->randomFloat(2, 0, 100),
            'food' => $this->faker->word,
            'energy' => $this->faker->word,
            'transport' => $this->faker->word,
        ];
    }
}
