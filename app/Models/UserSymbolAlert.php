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

    protected function casts(): array
    {
        return [
            'enable_price_alert' => 'boolean',
            'new_recommendation' => 'boolean',
            'latest_news' => 'boolean',
            'new_predictions' => 'boolean',
            'unusual_volume_alert' => 'boolean',
            'volatility_alert' => 'boolean',
            'earnings_report_alert' => 'boolean',
            'analyst_rating_alert' => 'boolean',
            'corporate_events_alert' => 'boolean',
            'market_movement_alert' => 'boolean',
            'ai_smart_alert' => 'boolean',
        ];
    }
}
