<?php

namespace App\Http\Controllers\API\V1\Static;

use App\Models\Symbol;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;

class GetIndicesAction
{
    public function __invoke(): JsonResponse
    {
        $indices = Cache::rememberForever('indices', function () {
            return Symbol::where('type', 'index')->get();
        });

        return response()->json($indices);
    }
}
