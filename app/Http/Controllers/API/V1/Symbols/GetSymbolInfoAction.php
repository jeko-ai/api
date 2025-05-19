<?php

namespace App\Http\Controllers\API\V1\Symbols;

use Illuminate\Http\JsonResponse;

class GetSymbolInfoAction
{
    public function __invoke($symbol): JsonResponse
    {
        return response()->json($symbol);
    }
}
