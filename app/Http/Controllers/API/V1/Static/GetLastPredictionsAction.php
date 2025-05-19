<?php

namespace App\Http\Controllers\API\V1\Static;

use DB;
use Illuminate\Support\Facades\Cache;

class GetLastPredictionsAction
{
    public function __invoke()
    {
        $predictions = Cache::remember("get_latest_symbol_price_predictions", 60 * 60, function () {
            $predictions = DB::select('select * from get_latest_symbol_price_predictions()');
            return collect($predictions)->keyBy('symbol_id');
        });

        return response()->json($predictions);
    }
}

