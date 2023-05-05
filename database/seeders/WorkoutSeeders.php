<?php

namespace Database\Seeders;

use App\Models\Exercise;
use App\Models\Serie;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Workout;
use Illuminate\Support\Facades\DB;

class WorkoutSeeders extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 10; $i++) {
            $workout = Workout::factory()->create();
            $exercise = Exercise::factory()->create();
            $serie = Serie::factory()->create();
    
            DB::table('serie_workout')->insert([
                'serie_id' => $serie->id,
                'workout_id' => $workout->id
            ]);
        }
    }
}
