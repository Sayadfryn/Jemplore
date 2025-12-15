<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TourismObject>
 */
class TourismObjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->city() . ' Park',
            'description' => fake()->paragraph(3),
            'address' => fake()->address(),
            'thumbnail' => 'tumpak-sewu.png', 
            'latitude' => fake()->latitude(),
            'longitude' => fake()->longitude(),
            'opening_hours' => '08:00:00',
            'closing_hours' => '17:00:00',
            'ticket_price' => 'Rp ' . fake()->numberBetween(5, 50) . '.000',
            'is_active' => true,
            'rating' => fake()->randomFloat(1, 3, 5),
            'total_reviews' => fake()->numberBetween(10, 500), 
        ];
    }
}
