<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class MarketMoversGainers extends Model
{
    use HasUuids;

    protected $table = 'market_movers_gainers';
    protected $fillable = [
        'symbol_id',
        'market_id',
        'price',
        'change_percent',
        'volume',
        'rel_volume',
        'market_cap',
        'pe_ratio',
        'eps_dil_ttm',
        'eps_dil_growth_ttm_yoy',
        'div_yield_ttm',
        'sector',
        'analyst_rating',
        'created_at',
    ];
}