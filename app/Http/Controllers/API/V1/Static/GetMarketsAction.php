<?php

namespace App\Http\Controllers\API\V1\Static;

use App\Models\Market;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;

class GetMarketsAction
{
    public function __invoke(): JsonResponse
    {
        $markets = Cache::rememberForever('markets', function () {
            return Market::all();
        });

        return response()->json($markets);
    }
}
