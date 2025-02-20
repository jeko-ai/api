<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class UserLevels extends Model
{
    use HasUuids;

    protected $table = 'user_levels';
    protected $fillable = [
        'user_id',
        'level_id',
        'xp',
        'created_at',
    ];
}