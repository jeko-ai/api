<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Challenges extends Model
{
    use HasUuids;

    protected $table = 'challenges';
    protected $fillable = [
        'slug',
        'name_ar',
        'name_en',
        'description_ar',
        'description_en',
        'reward_points',
        'xp',
        'status',
        'created_at',
    ];
}