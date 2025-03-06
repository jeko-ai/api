<?php

namespace App\Http\Controllers\API\V1\Static;

use App\Models\MarketMoversGainers;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;

class GetBestAction
{
    public function __invoke(string $market): JsonResponse
    {
        $best = Cache::remember("best-{$market}", 1440, function () use ($market) {
            return MarketMoversGainers::where('market_id', $market)->get();
        });

        return response()->json($best->random(8));
    }
}
