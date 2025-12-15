<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Culinary>
 */
class CulinaryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
{
    return [
        'name' => fake()->word() . ' Delight',
        'image' => 'foods.png',
        'primary_tag' => fake()->randomElement(['Traditional', 'Modern', 'Snack', 'Beverage']),
        'secondary_tags' => ['Spicy', 'Sweet', 'Halal'], 
        'price_type' => 'single',
        'price' => fake()->numberBetween(10000, 50000),
        'description' => fake()->sentence(10),
        'best_at' => fake()->randomElement(['Breakfast', 'Lunch', 'Dinner']),
        'rating' => 0,
        'total_reviews' => 0,
    ];
}
}
