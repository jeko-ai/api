<?php

namespace App\Http\Controllers\API\V1\Static;

use App\Models\MarketMoversGainer;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;

class GetCompaniesAction
{
    public function __invoke(string $market): JsonResponse
    {
        $items = Cache::remember("best-{$market}", 1440, function () use ($market) {
            return MarketMoversGainer::where('market_id', $market)->get();
        });

        $count = $items->count();
        $itemsToReturn = $count >= 8 ? $items->random(8) : $items;

        return response()->json($itemsToReturn);
    }
}

