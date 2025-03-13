<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class UserChallenge extends Model
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
