<?php

namespace App\Http\Controllers\API\V1\Static;

use App\Models\Sector;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;

class GetSectorsAction
{
    public function __invoke(): JsonResponse
    {
        $sectors = Cache::rememberForever('sectors', function () {
            return Sector::whereHas('symbols')->get();
        });

        return response()->json($sectors);
    }
}
