<?php

namespace App\Http\Controllers\API\V1\Static;

use App\Models\Countries;
use Illuminate\Support\Facades\Cache;

class GetCountriesAction
{
    public function __invoke()
    {
        return Cache::rememberForever('countries', function () {
            return Countries::all();
        });
    }
}
