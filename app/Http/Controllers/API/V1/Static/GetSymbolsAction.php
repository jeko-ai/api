<?php

namespace App\Http\Controllers\API\V1\Static;

use App\Models\Symbols;
use Illuminate\Support\Facades\Cache;

class GetSymbolsAction
{
    public function __invoke()
    {
        return Cache::rememberForever('symbols', function () {
            return Symbols::where('type', 'stock')->get();
        });
    }
}
