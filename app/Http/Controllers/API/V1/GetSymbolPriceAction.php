<?php

namespace App\Http\Controllers\API\V1;

use App\Models\SymbolPrices;

class GetSymbolPriceAction
{
    public function __invoke(string $id)
    {
        return SymbolPrices::where('id', $id)->orderByDesc('timestamp')->first();
    }
}
