<?php

namespace App\Http\Controllers\API\V1\Static;

use App\Models\Symbol;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;

class GetSymbolsAction
{
    public function __invoke(): JsonResponse
    {
        $symbols = Cache::rememberForever('symbols', function () {
            return Symbol::where('type', 'stock')->get();
        });

        return response()->json($symbols);
    }
}
