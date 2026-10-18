<?php

namespace Database\Factories;

use App\Enums\ProjectStatus;
use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    public function definition(): array
    {
        return [
            'customer_id' => Customer::factory(),
            'name' => fake()->randomElement(['Website', 'Kundenportal', 'Online-Shop', 'Intranet', 'Buchungstool', 'App-Backend', 'Lagerverwaltung', 'Newsletter-Tool']),
            'status' => fake()->randomElement(ProjectStatus::cases()),
            'description' => fake()->optional()->sentence(12),
        ];
    }
}
