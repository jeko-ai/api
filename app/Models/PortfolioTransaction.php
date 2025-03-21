<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PortfolioTransaction extends Model
{
    use HasUuids;

    protected $table = 'portfolio_transactions';

    protected $fillable = [
        'portfolio_id',
        'symbol_id',
        'quantity',
        'price_per_unit',
        'transaction_type',
        'executed_at',
        'user_id',
    ];

    public function symbol(): HasOne
    {
        return $this->hasOne(Symbol::class, 'id', 'symbol_id');
    }
}
