<?php

namespace Database\Factories;

use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\TimeEntry>
 */
class TimeEntryFactory extends Factory
{
    public function definition(): array
    {
        return [
            'project_id' => Project::factory(),
            'date' => fake()->dateTimeBetween('-3 months', 'now'),
            'minutes' => fake()->randomElement([15, 30, 45, 60, 90, 120, 180, 240]),
            'description' => fake()->randomElement(['Meeting mit Kunde', 'Konzept', 'Umsetzung Formular', 'Bugfix', 'Code-Review', 'Deployment', 'Tests geschrieben', 'Datenbank angepasst', 'Support-Anfrage']),
            'billable' => fake()->boolean(85),
        ];
    }
}
