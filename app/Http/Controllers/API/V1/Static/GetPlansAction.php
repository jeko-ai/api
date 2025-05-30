<?php

namespace App\Http\Controllers\API\V1\Static;

use App\Models\Plan;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;

class GetPlansAction
{
    public function __invoke(): JsonResponse
    {
        $locale = request()->header('Accept-Language', request('locale', 'en'));

        $plans = Cache::rememberForever("plans-$locale", function () {
            return Plan::with('features')->orderBy('sort_order')->get();
        });

        return response()->json($plans);
    }
}
