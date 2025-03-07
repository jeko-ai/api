<?php

namespace App\Http\Controllers\API\V1\Symbols;

use App\Models\Symbols;
use Illuminate\Support\Facades\Cache;

class GetSymbolTechnicalAction
{
    public function __invoke(string $symbol, string $timeframe)
    {
        $symbols = Cache::rememberForever('symbols', function () {
            return Symbols::where('type', 'stock')->get();
        });
        $symbol = collect($symbols)->keyBy('id')->get($symbol);
    }
}
