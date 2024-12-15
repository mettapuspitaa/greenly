<?php

namespace Database\Factories;

use App\Models\UserAccount;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class UserAccountFactory extends Factory
{
    protected $model = UserAccount::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => Hash::make('password123'), // Default test password
            'role' => 'user', // Adjust roles as needed
        ];
    }
}
