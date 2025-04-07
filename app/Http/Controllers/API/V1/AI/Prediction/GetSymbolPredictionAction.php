<?php

namespace App\Http\Controllers\API\V1\AI\Prediction;

use App\Models\SymbolPricePrediction;
use Illuminate\Http\JsonResponse;

/**
 * @OA\Get(
 *     path="/v1/symbols/{symbol}/prediction",
 *     summary="Get symbol price prediction",
 *     description="Retrieves the latest price prediction for a specific symbol",
 *     tags={"AI Predictions"},
 *     @OA\Parameter(
 *         name="symbol",
 *         in="path",
 *         required=true,
 *         description="Symbol ID to retrieve prediction for",
 *         @OA\Schema(type="string")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Symbol prediction retrieved successfully",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="id", type="string", format="uuid"),
 *             @OA\Property(property="symbol_id", type="string"),
 *             @OA\Property(property="prediction_date", type="string", format="date-time"),
 *             @OA\Property(property="prediction_price", type="number"),
 *             @OA\Property(property="confidence_level", type="number"),
 *             @OA\Property(property="prediction_type", type="string"),
 *             @OA\Property(property="timeframe", type="string"),
 *             @OA\Property(property="created_at", type="string", format="date-time"),
 *             @OA\Property(property="updated_at", type="string", format="date-time")
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="No prediction found for this symbol"
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Internal Server Error"
 *     )
 * )
 */
class GetSymbolPredictionAction
{
    public function __invoke($symbol): JsonResponse
    {
        $prediction = SymbolPricePrediction::where('symbol_id', $symbol)
            ->orderByDesc('prediction_date')
            ->first();
        return response()->json($prediction);
    }
}
