<?php

namespace App\Http\Controllers\API\V1\Static;

use App\Models\MarketMoversLosers;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;

class GetWorstAction
{
    public function __invoke(string $market): JsonResponse
    {
        $items = Cache::remember("worst-{$market}", 1440, function () use ($market) {
            return MarketMoversLosers::where('market_id', $market)->get();
        });

        $count = $items->count();
        $itemsToReturn = $count >= 8 ? $items->random(8) : $items;

        return response()->json($itemsToReturn);
    }
}
