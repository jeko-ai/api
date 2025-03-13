<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class UserBadge extends Model
{
    use HasUuids;

    protected $table = 'user_badges';
    protected $fillable = [
        'user_id',
        'badge_id',
        'earned_at',
    ];
}
