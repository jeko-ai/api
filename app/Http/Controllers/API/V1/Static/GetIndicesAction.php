<?php

namespace App\Http\Controllers\API\V1\Static;

use App\Models\Symbols;
use Illuminate\Support\Facades\Cache;

class GetIndicesAction
{
    public function __invoke()
    {
        return Cache::rememberForever('indices', function () {
            return Symbols::where('type', 'index')->get();
        });
    }
}
