<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Project;
use App\Models\TimeEntry;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $anna = User::factory()->create([
            'name' => 'Anna Keller',
            'email' => 'anna@bergsicht.example',
            'password' => 'passwort',
        ]);

        $ben = User::factory()->create([
            'name' => 'Ben Wyss',
            'email' => 'ben@bergsicht.example',
            'password' => 'passwort',
        ]);

        foreach ([$anna, $ben] as $user) {
            Customer::factory(12)->for($user)->create()->each(function (Customer $customer) {
                Project::factory(fake()->numberBetween(1, 3))
                    ->for($customer)
                    ->create()
                    ->each(fn (Project $project) => TimeEntry::factory(fake()->numberBetween(3, 8))->for($project)->create());
            });
        }
    }
}
