<?php

namespace App\Http\Controllers\API\V1\Symbols;

use App\Models\Symbols;
use Illuminate\Support\Facades\Cache;

class GetSymbolChartInfoAction
{
    public function __invoke($symbol)
    {
        $symbols = Cache::rememberForever('symbols', function () {
            return Symbols::where('type', 'stock')->get();
        });
        $symbol = collect($symbols)->keyBy('id')->get($symbol);

        return response()->json([
            $symbol,
            collect($symbols)->keyBy('id')
        ]);
    }
}
