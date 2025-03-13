<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasUuids;

    protected $table = 'subscriptions';
    protected $fillable = [
        'user_id',
        'plan_id',
        'start_date',
        'end_date',
        'auto_renew',
        'status',
        'created_at',
        'updated_at',
    ];
}
