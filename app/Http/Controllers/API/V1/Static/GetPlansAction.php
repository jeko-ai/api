<?php

namespace App\Http\Controllers\API\V1\Static;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;
use Laravelcm\Subscriptions\Models\Plan;

class GetPlansAction
{
    public function __invoke(): JsonResponse
    {
        $plans = Cache::rememberForever('plans', function () {
            return Plan::with('features')->orderBy('sort_order')->get();
        });

        return response()->json($plans);
    }
}
