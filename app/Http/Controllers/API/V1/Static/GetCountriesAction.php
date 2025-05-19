<?php

namespace App\Http\Controllers\API\V1\Static;

use App\Models\Country;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;

class GetCountriesAction
{
    public function __invoke(): JsonResponse
    {
        $countries = Cache::rememberForever('countries', function () {
            return Country::all();
        });

        return response()->json($countries);
    }
}
