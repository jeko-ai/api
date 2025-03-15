<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Challenge extends Model
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
