<?php

namespace App\Http\Controllers\API\V1\Pricing;

use App\Models\SymbolPrice;


class GetPricesAction
{
    public function __invoke()
    {
        return SymbolPrice::select('symbol', 'price')
            ->orderBy('timestamp')
            ->groupBy('symbol_id')
            ->get();
    }
}

