<?php

namespace App\Http\Controllers\API\V1\Pricing;

use App\Models\SymbolPrice;

class GetSymbolPriceAction
{
    public function __invoke(string $id)
    {
        return SymbolPrice::where('id', $id)->orderByDesc('timestamp')->first();
    }
}
