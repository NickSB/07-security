<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'name' => fake()->company(),
            'email' => fake()->unique()->companyEmail(),
            'phone' => fake()->optional()->phoneNumber(),
            'city' => fake()->city(),
            'hourly_rate' => fake()->randomElement([120, 140, 160]),
            'notes' => fake()->optional(0.5)->passthrough(fake()->sentence(8)."\n".fake()->sentence(6)),
        ];
    }
}
