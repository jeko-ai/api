<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Reward extends Model
{
    use HasUuids;

    protected $table = 'rewards';
    protected $fillable = [
        'user_id',
        'points',
        'xp',
        'type',
        'status',
        'created_at',
    ];
}
