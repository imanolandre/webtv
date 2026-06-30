<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'description', 'year', 'genres',
        'video_url', 'poster_portrait', 'poster_landscape', 'is_visible'
    ];

    protected $casts = [
        'genres' => 'array',
        'is_visible' => 'boolean',
    ];
}
