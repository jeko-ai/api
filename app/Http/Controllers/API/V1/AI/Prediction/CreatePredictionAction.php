<?php

namespace App\Http\Controllers\API\V1\AI\Prediction;

use App\Http\Requests\API\V1\CreatePredictionRequest;
use App\Jobs\NotifyBrainAboutNewRequestJob;
use App\Models\PricePredictionRequest;
use App\Models\Subscription;
use App\Models\Symbol;
use Carbon\Carbon;
use F9Web\ApiResponseHelpers;
use Illuminate\Support\Facades\Cache;

/**
 * @OA\Post(
 *     path="/v1/ai/predictions",
 *     summary="Create a new price prediction",
 *     description="Creates a new AI price prediction request for a stock symbol",
 *     operationId="createPrediction",
 *     tags={"AI Predictions"},
 *     security={{"bearerAuth":{}}},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"id", "prediction_type", "prediction_start_date", "prediction_end_date"},
 *             @OA\Property(property="id", type="integer", description="Symbol ID"),
 *             @OA\Property(property="prediction_type", type="string", description="Type of prediction", example="price"),
 *             @OA\Property(property="prediction_start_date", type="string", format="date", description="Start date for prediction"),
 *             @OA\Property(property="prediction_end_date", type="string", format="date", description="End date for prediction")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Prediction request created successfully",
 *         @OA\JsonContent(
 *             @OA\Property(property="id", type="integer"),
 *             @OA\Property(property="user_id", type="integer"),
 *             @OA\Property(property="symbol_id", type="integer"),
 *             @OA\Property(property="symbol", type="string"),
 *             @OA\Property(property="market_id", type="integer"),
 *             @OA\Property(property="prediction_type", type="string"),
 *             @OA\Property(property="prediction_start_date", type="string", format="date-time"),
 *             @OA\Property(property="prediction_end_date", type="string", format="date-time"),
 *             @OA\Property(property="status", type="string", default="pending"),
 *             @OA\Property(property="created_at", type="string", format="date-time"),
 *             @OA\Property(property="updated_at", type="string", format="date-time")
 *         )
 *     ),
 *     @OA\Response(
 *         response=400,
 *         description="Bad request or validation error",
 *         @OA\JsonContent(
 *             @OA\Property(property="status", type="string", example="error"),
 *             @OA\Property(property="message", type="string", example="Validation errors")
 *         )
 *     ),
 *     @OA\Response(
 *         response=400,
 *         description="Subscription limit reached or not allowed",
 *         @OA\JsonContent(
 *             @OA\Property(property="status", type="string", example="error"),
 *             @OA\Property(property="message", type="string", example="You have reached the limit of your plan for this feature")
 *         )
 *     )
 * )
 */
class CreatePredictionAction
{
    use ApiResponseHelpers;

    public function __invoke(CreatePredictionRequest $request)
    {
        /** @var Subscription $subscription */
        $subscription = $request->user()->activePlanSubscriptions()->first();
        if (!$subscription) {
            return $this->respondError(__("Subscription not found"));
        }

        if (!$subscription->canUseFeature('ai-stock-predictions')) {
            return $this->respondError(__('You have reached the limit of your plan for this feature'));
        }

        $symbols = Cache::rememberForever('symbols', function () {
            return Symbol::where('type', 'stock')->get();
        });
        $symbol = collect($symbols)->keyBy('id')->get($request->id);
        $market = $symbol?->market;

        $prediction = PricePredictionRequest::create([
            'user_id' => $request->user()->id,
            'symbol_id' => $symbol?->id,
            'symbol' => $symbol?->symbol,
            'market_id' => $symbol?->market_id,
            'prediction_type' => $request->prediction_type,
            'prediction_start_date' => Carbon::parse($request->prediction_start_date)->setTimeFromTimeString($market->open_at),
            'prediction_end_date' => Carbon::parse($request->prediction_end_date)->setTimeFromTimeString($market->close_at),
        ]);
        // Notify Brain about the new prediction request
        NotifyBrainAboutNewRequestJob::dispatch(PricePredictionRequest::class);

        $subscription->recordFeatureUsage('ai-stock-predictions');

        return response()->json($prediction);
    }
}

