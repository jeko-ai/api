<?php

namespace App\Http\Controllers\API\V1\Static;

use App\Models\Markets;
use Illuminate\Support\Facades\Cache;

class GetMarketsAction
{
    public function __invoke()
    {
        return Cache::rememberForever('markets', function () {
            return Markets::all();
        });
    }
}
