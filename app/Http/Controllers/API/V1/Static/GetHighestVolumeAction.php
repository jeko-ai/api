<?php

namespace App\Http\Controllers\API\V1\Static;

use App\Models\MarketMoversActive;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;

class GetHighestVolumeAction
{
    public function __invoke(string $market): JsonResponse
    {
        $movers = Cache::remember("highest-volume-{$market}", 1440, function () use ($market) {
            return MarketMoversActive::where('market_id', $market)->get();
        });

        return response()->json($movers->random(8));
    }
}
