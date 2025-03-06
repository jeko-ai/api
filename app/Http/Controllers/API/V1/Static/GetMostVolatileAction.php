<?php

namespace App\Http\Controllers\API\V1\Static;

use App\Models\MarketMostVolatile;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;

class GetMostVolatileAction
{
    public function __invoke(string $market): JsonResponse
    {
        $volatiles = Cache::remember("most-volatile-{$market}", 1440, function () use ($market) {
            return MarketMostVolatile::where('market_id', $market)->get();
        });

        return response()->json($volatiles->random(8));
    }
}
