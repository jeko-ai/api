<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class SubscriptionFeatureUsage extends Model
{
    use HasUuids;

    protected $table = 'subscription_feature_usage';
    protected $fillable = [
        'user_id',
        'subscription_feature_id',
        'subscription_id',
        'used_count',
        'usage_date',
    ];
}