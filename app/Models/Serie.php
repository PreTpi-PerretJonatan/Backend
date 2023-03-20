<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Serie extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'sets_number',
        'time_between_sets',
        'time_after_sets',
        'exercise_id'
    ];

    public function exercise(): BelongsTo
    {
        return $this->belongsTo(Exercise::class);
    }

    public function workouts() : BelongsToMany
    {
        return $this->belongsToMany(Workout::class);
    }
}
