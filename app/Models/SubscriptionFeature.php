<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class SubscriptionFeature extends Model
{
    use HasUuids;

    protected $table = 'subscription_features';
    protected $fillable = [
        'subscription_id',
        'feature_key',
        'feature_name_ar',
        'feature_name_en',
        'feature_limit',
        'limit_per',
        'created_at',
    ];
}
