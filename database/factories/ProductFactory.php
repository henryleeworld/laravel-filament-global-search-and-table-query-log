<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->unique()->catchPhrase(),
            'is_visible' => fake()->boolean(),
            'old_price' => fake()->randomFloat(2, 100, 500),
            'price' => fake()->randomFloat(2, 80, 400),
            'cost' => fake()->randomFloat(2, 50, 200),
        ];
    }
}
