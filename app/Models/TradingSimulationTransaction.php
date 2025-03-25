<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TradingSimulationTransaction extends Model
{
    use HasUuids;

    protected $table = 'trading_simulation_transactions';

    protected $fillable = [
        'trading_simulation_request_id',
        'timestamp',
        'symbol',
        'action',
        'price',
        'quantity',
        'reason_en',
        'reason_ar',
    ];

    protected $casts = [
        'timestamp' => 'datetime',
        'price' => 'decimal:2',
        'quantity' => 'integer',
    ];

    /**
     * Get the trading simulation request that owns the transaction.
     */
    public function tradingSimulationRequest(): BelongsTo
    {
        return $this->belongsTo(TradingSimulationRequest::class, 'trading_simulation_request_id');
    }
}
