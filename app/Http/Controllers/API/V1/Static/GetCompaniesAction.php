<?php

namespace App\Http\Controllers\API\V1\Static;

use App\Models\MarketMoversGainers;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;

class GetCompaniesAction
{
    public function __invoke(string $market): JsonResponse
    {
        $companies = Cache::remember("best-{$market}", 1440, function () use ($market) {
            return MarketMoversGainers::where('market_id', $market)->get();
        });

        return response()->json($companies->random(8));
    }
}
