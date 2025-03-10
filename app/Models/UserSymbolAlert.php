<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class UserSymbolAlert extends Model
{
    use HasUuids;

    protected $table = 'user_symbol_alerts';

    protected $fillable = [
        'user_id',
        'symbol_id',
        'inv_id',
        'tv_id',
        'enable_price_alert',
        'price_alert',
        'new_recommendation',
        'latest_news',
        'new_predictions',
        'unusual_volume_alert',
        'volatility_alert',
        'earnings_report_alert',
        'analyst_rating_alert',
        'corporate_events_alert',
        'market_movement_alert',
        'ai_smart_alert',
    ];
}
