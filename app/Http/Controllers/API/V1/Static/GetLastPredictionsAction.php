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
 *         @OA\JsonContent(type="array", @OA\Items(type="object",
 *             @OA\Property(property="id", type="string", format="uuid", description="Prediction unique identifier"),
 *             @OA\Property(property="pid", type="string", description="Prediction ID"),
 *             @OA\Property(property="symbol_id", type="string", format="uuid", description="Symbol unique identifier"),
 *             @OA\Property(property="market_id", type="string", format="uuid", description="Market unique identifier"),
 *             @OA\Property(property="symbol", type="string", description="Symbol code"),
 *             @OA\Property(property="market", type="string", description="Market name"),
 *             @OA\Property(property="prediction_date", type="string", format="date-time", description="Date of the prediction"),
 *             @OA\Property(property="predicted_price", type="number", format="float", description="Predicted price value"),
 *             @OA\Property(property="confidence_level", type="number", format="float", description="Confidence level of the prediction"),
 *             @OA\Property(property="prediction_interval", type="string", description="Interval of the prediction"),
 *             @OA\Property(property="created_at", type="string", format="date-time", description="Creation timestamp"),
 *             @OA\Property(property="updated_at", type="string", format="date-time", description="Last update timestamp")
 *         ))
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

