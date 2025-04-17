<?php

namespace App\Http\Controllers\API\V1\AI\Prediction;

use App\Jobs\NotifyBrainAboutNewRequestJob;
use App\Models\PricePredictionRequest;
use Illuminate\Support\Facades\Cache;

/**
 * @OA\Get(
 *     path="/v1/ai/predictions/{id}",
 *     summary="Get a specific prediction",
 *     description="Retrieves a specific price prediction by ID",
 *     operationId="getPrediction",
 *     tags={"AI Predictions"},
 *     security={{"bearerAuth":{}}},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="ID of the prediction to retrieve",
 *         required=true,
 *         @OA\Schema(type="string")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Prediction retrieved successfully",
 *         @OA\JsonContent(
 *             @OA\Property(property="id", type="integer"),
 *             @OA\Property(property="user_id", type="integer"),
 *             @OA\Property(property="symbol_id", type="integer"),
 *             @OA\Property(property="symbol", type="string"),
 *             @OA\Property(property="market_id", type="integer"),
 *             @OA\Property(property="prediction_type", type="string"),
 *             @OA\Property(property="prediction_start_date", type="string", format="date-time"),
 *             @OA\Property(property="prediction_end_date", type="string", format="date-time"),
 *             @OA\Property(property="status", type="string"),
 *             @OA\Property(property="created_at", type="string", format="date-time"),
 *             @OA\Property(property="updated_at", type="string", format="date-time"),
 *             @OA\Property(
 *                 property="results",
 *                 type="array",
 *                 @OA\Items(
 *                     @OA\Property(property="id", type="integer"),
 *                     @OA\Property(property="prediction_id", type="integer"),
 *                     @OA\Property(property="date", type="string", format="date"),
 *                     @OA\Property(property="open", type="number", format="float"),
 *                     @OA\Property(property="high", type="number", format="float"),
 *                     @OA\Property(property="low", type="number", format="float"),
 *                     @OA\Property(property="close", type="number", format="float"),
 *                     @OA\Property(property="volume", type="integer"),
 *                     @OA\Property(property="created_at", type="string", format="date-time"),
 *                     @OA\Property(property="updated_at", type="string", format="date-time")
 *                 )
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Prediction not found",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="Prediction not found")
 *         )
 *     )
 * )
 */
class GetPredictionAction
{
    public function __invoke(string $id)
    {
        $cacheKey = "prediction_{$id}";

        // Check if the prediction is in the cache
        $prediction = Cache::get($cacheKey);

        if (!$prediction) {
            // Retrieve the prediction from the database
            $prediction = PricePredictionRequest::with('results')->where('user_id', auth()->user()->id)->find($id);

            if (request()->has('retry') && request('retry')) {
                $prediction->status = 'pending';
                $prediction->save();
                // Notify Brain about the new prediction request
                NotifyBrainAboutNewRequestJob::dispatch(PricePredictionRequest::class);
            }

            // Cache the prediction if the status is "completed"
            if ($prediction && $prediction->status === 'completed') {
                Cache::put($cacheKey, $prediction, now()->addMinutes(60)); // Cache for 60 minutes
            }
        }

        return response()->json($prediction);
    }
}

