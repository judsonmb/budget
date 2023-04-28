<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Customer;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class DesktopProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'supported_os' => fake()->randomElement(['Windows', 'Linux', 'MacOS']),
            'screens_number' => fake()->numberBetween(1, 10),
            'supports_prints' => fake()->randomElement([0,1]),
            'access_license' => fake()->randomElement([0,1]),
            //'customer_id' => (string) Customer::inRandomOrder()->first()->id
        ];
    }
}
