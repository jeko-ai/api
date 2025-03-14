<?php

namespace App\Http\Controllers\API\V1\Static;

use App\Models\Plan;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;

class GetPlansAction
{
    public function __invoke(): JsonResponse
    {
        $plans = Cache::rememberForever('plans', function () {
            return Plan::orderBy('price')->get();
        });

        return response()->json($plans);
    }
}
