<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TradingSimulationRequest extends Model
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
        'stock_selections',
        'portfolio_value_over_time',
        'final_portfolio_status',
        'performance_metrics',
        'strategy_analysis_en',
        'strategy_analysis_ar',
        'expected_return_analysis_en',
        'expected_return_analysis_ar',
        'overall_summary_and_learnings_en',
        'overall_summary_and_learnings_ar',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'symbols' => 'array',
        'sectors' => 'array',
        'stock_selections' => 'array',
        'portfolio_value_over_time' => 'array',
        'final_portfolio_status' => 'array',
        'performance_metrics' => 'array',
    ];

    /**
     * Get the transactions for the trading simulation request.
     */
    public function transactions(): HasMany
    {
        return $this->hasMany(TradingSimulationTransaction::class, 'trading_simulation_request_id')->orderBy('timestamp');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function market(): BelongsTo
    {
        return $this->belongsTo(Market::class, 'market_id');
    }
}
