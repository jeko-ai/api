<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Rewards extends Model
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