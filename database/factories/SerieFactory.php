<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Serie>
 */
class SerieFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => 'Serie' . rand(1, 100),
            'sets_number' => rand(1, 3),
            'time_between_sets' => rand(30, 60) . 'sec',
            'time_after_sets' => rand(30, 60) . 'sec',
            'exercise_id' => '1',
        ];
    }
}
