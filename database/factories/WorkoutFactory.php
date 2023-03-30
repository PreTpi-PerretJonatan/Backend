<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Workout>
 */
class WorkoutFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => 'Workout' . rand(1, 100),
            'id_type' => '',
            'approximate_duration' => fake()->randomFloat(2, 0.5, 2) . 'h',
            'cover_image_url' => fake()->imageUrl(),
        ];
    }
}
