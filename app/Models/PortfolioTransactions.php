<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PortfolioTransactions extends Model
{
    use HasUuids;

    public $timestamps = false;

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
        return $this->hasOne(Symbols::class, 'id', 'symbol_id');
    }
}
