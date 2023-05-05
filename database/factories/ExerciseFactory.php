<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Exercise>
 */
class ExerciseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => 'Exercise' . rand(1, 100),
            'repetitions' => rand(8, 12),
            'diffuculty' => 'Beginner', // 'Beginner', 'Intermediate', 'Advanced
            'path_to_cover_image' => 'https://fitfocus.cld.education/Ressources/Images/WorkoutExample.png',
            'path_to_video' => 'https://fitfocus.cld.education/Ressources/Videos/WorkoutExample.mp4',
        ];
    }
}
