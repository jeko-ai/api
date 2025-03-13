<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasUuids;

    protected $table = 'profiles';
    protected $fillable = [
        'full_name',
        'language',
        'risk_level',
        'country_id',
        'is_notification_enabled',
        'is_price_alerts_enabled',
        'is_new_recommendations_alerts_enabled',
        'is_portfolio_update_alerts_enabled',
        'is_market_sentiment_alerts_enabled',
        'created_at',
        'fcm_token',
    ];
}
