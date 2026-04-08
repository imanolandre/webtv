<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    protected $fillable = [
        'name',
        'stream_url',
        'type',
        'logo',
        'is_active',
    ];
}
