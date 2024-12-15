<?php

namespace Database\Factories;

use App\Models\Emission;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmissionFactory extends Factory
{
    protected $model = Emission::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'type' => $this->faker->randomElement(['Carbon', 'Methane', 'Nitrous Oxide']),
            'emission' => $this->faker->randomFloat(2, 0, 1000), // Random float with 2 decimal places
        ];
    }
}
