<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PortfolioAsset extends Model
{
    use HasUuids;

    protected $table = 'portfolio_assets';
    protected $fillable = [
        'portfolio_id',
        'user_id',
        'symbol_id',
        'quantity',
        'avg_buy_price',
        'total_value',
        'buy_date',
        'created_at',
        'current_price',
        'profit_loss',
        'dividends_received',
    ];

    public function symbol(): HasOne
    {
        return $this->hasOne(Symbol::class, 'id', 'symbol_id');
    }
}
