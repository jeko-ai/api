<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class UserChallenges extends Model
{
    use HasUuids;

    protected $table = 'user_challenges';
    protected $fillable = [
        'user_id',
        'challenge_id',
        'progress',
        'completed',
        'completed_at',
    ];
}