<?php

namespace App\Http\Controllers\API\V1\Symbols;

use App\Models\Symbols;
use Illuminate\Support\Facades\Cache;

class GetSymbolInfoAction
{
    public function __invoke($symbol)
    {
        return response()->json($symbol);
    }
}
