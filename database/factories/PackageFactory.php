<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Package>
 */
class PackageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
{
    return [
        'name' => 'Paket ' . fake()->word(),
        'description' => fake()->paragraph(),
        'price' => fake()->numberBetween(500000, 2000000),
        'thumbnail' => 'hero-bg.png',
        'features' => ['Transport', 'Guide', 'Snack', 'Dokumentasi'],
    ];
}
}
