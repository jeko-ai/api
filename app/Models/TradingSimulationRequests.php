<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class TradingSimulationRequests extends Model
{
    use HasUuids;

    protected $table = 'trading_simulation_requests';
    protected $fillable = [
        'user_id',
        'market_id',
        'symbols',
        'sectors',
        'investment_amount',
        'risk_level',
        'duration',
        'strategy',
        'start_time',
        'end_time',
        'expected_return_percentage',
        'stop_loss_percentage',
        'status',
        'selected_type',
        'results',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'symbols' => 'array',
        'sectors' => 'array',
    ];
}
