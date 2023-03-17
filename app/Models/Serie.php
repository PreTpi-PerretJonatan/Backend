<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Serie extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'sets_number',
        'time_between_sets',
        'time_after_sets',
        'exercise'
    ];

    public Exercise $exercise;
}
