<?php

namespace App\Http\Controllers\API\V1\Symbols;

use App\Models\Symbols;
use Illuminate\Support\Facades\Cache;

class GetSymbolInfoAction
{
    public function __invoke($symbol)
    {
//        $symbols = Cache::rememberForever('symbols', function () {
//            return Symbols::where('type', 'stock')->get();
//        });
//        $symbols->

        return response()->json($symbol);
    }
}
