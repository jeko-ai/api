<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class UserBadges extends Model
{
    use HasUuids;

    protected $table = 'user_badges';
    protected $fillable = [
        'user_id',
        'badge_id',
        'earned_at',
    ];
}