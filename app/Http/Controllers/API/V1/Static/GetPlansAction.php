<?php

namespace App\Http\Controllers\API\V1\Static;

use App\Models\Plans;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;

class GetPlansAction
{
    public function __invoke(): JsonResponse
    {
        $plans = Cache::rememberForever('plans', function () {
            return Plans::orderBy('price')->get();
        });

        return response()->json($plans);
    }
}
