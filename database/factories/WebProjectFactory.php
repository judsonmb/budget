<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Customer;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class WebProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'pages_number' => fake()->numberBetween(1, 10),
            'has_login' => fake()->randomElement([0,1]),
            'has_payment' => fake()->randomElement([0,1]),
            'customer_id' => (string) Customer::inRandomOrder()->first()->id
        ];
    }
}
