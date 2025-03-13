<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class UserLevel extends Model
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
