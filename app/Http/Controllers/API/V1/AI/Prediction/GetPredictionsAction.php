<?php

namespace App\Http\Controllers\API\V1\AI\Prediction;

use App\Models\PricePredictionRequest;

class GetPredictionsAction
{
    /**
     * @OA\Get(
     *     path="/v1/ai/predictions",
     *     summary="Get user predictions",
     *     description="Retrieves all price predictions for the authenticated user",
     *     operationId="getPredictions",
     *     tags={"AI Predictions"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="user_id", type="integer", example=1),
     *                 @OA\Property(property="symbol_id", type="integer", example=1),
     *                 @OA\Property(property="symbol", type="string", example="BTC"),
     *                 @OA\Property(property="market_id", type="integer", example=1),
     *                 @OA\Property(property="prediction_type", type="string", example="price"),
     *                 @OA\Property(property="prediction_start_date", type="string", format="date-time", example="2023-01-01T00:00:00Z"),
     *                 @OA\Property(property="prediction_end_date", type="string", format="date-time", example="2023-01-07T00:00:00Z"),
     *                 @OA\Property(property="status", type="string", example="completed"),
     *                 @OA\Property(property="created_at", type="string", format="date-time", example="2023-01-01T00:00:00Z")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthenticated"
     *     )
     * )
     */
    public function __invoke()
    {
        return PricePredictionRequest::where('user_id', request()->user()->id)
            ->select([
                'id',
                'user_id',
                'symbol_id',
                'symbol',
                'market_id',
                'prediction_type',
                'prediction_start_date',
                'prediction_end_date',
                'status',
                'created_at',
            ])
            ->orderByDesc('created_at')
            ->get();
    }
}

