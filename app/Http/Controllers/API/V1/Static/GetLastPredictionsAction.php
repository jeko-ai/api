<?php

namespace App\Http\Controllers\API\V1\Static;

use DB;
use Illuminate\Support\Facades\Cache;

/**
 * @OA\Get(
 *     path="/v1/static/last-predictions",
 *     summary="Get last predictions",
 *     tags={"Static"},
 *     @OA\Response(
 *         response=200,
 *         description="Successful operation",
 *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Prediction"))
 *     ),
 *     @OA\Response(
 *         response=400,
 *         description="Bad request"
 *     )
 * )
 */
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

