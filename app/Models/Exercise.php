<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Exercise extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'repetitions',
        'path_to_cover_image',
        'path_to_video'
    ];

    public function series():BelongsToMany
    {
        return $this->belongsToMany(Serie::class);
    }
}
