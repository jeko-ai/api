<?php

namespace App\Http\Controllers\API\V1\Symbols;

use App\Models\UserSymbolAlert;
use Illuminate\Http\JsonResponse;

/**
 * @OA\Get(
 *     path="/v1/symbols/{symbol}/alerts",
 *     summary="Get symbol alerts for the authenticated user",
 *     description="Retrieves alert settings for a specific symbol for the authenticated user",
 *     tags={"Symbols"},
 *     @OA\Parameter(
 *         name="symbol",
 *         in="path",
 *         required=true,
 *         description="Symbol ID to retrieve alerts for",
 *         @OA\Schema(type="string")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Symbol alerts retrieved successfully",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="id", type="string", format="uuid"),
 *             @OA\Property(property="user_id", type="string"),
 *             @OA\Property(property="symbol_id", type="string"),
 *             @OA\Property(property="inv_id", type="string", nullable=true),
 *             @OA\Property(property="tv_id", type="string", nullable=true),
 *             @OA\Property(property="enable_price_alert", type="boolean"),
 *             @OA\Property(property="price_alert", type="number", nullable=true),
 *             @OA\Property(property="new_recommendation", type="boolean"),
 *             @OA\Property(property="latest_news", type="boolean"),
 *             @OA\Property(property="new_predictions", type="boolean"),
 *             @OA\Property(property="unusual_volume_alert", type="boolean"),
 *             @OA\Property(property="volatility_alert", type="boolean"),
 *             @OA\Property(property="earnings_report_alert", type="boolean"),
 *             @OA\Property(property="analyst_rating_alert", type="boolean"),
 *             @OA\Property(property="corporate_events_alert", type="boolean"),
 *             @OA\Property(property="market_movement_alert", type="boolean"),
 *             @OA\Property(property="ai_smart_alert", type="boolean"),
 *             @OA\Property(property="created_at", type="string", format="date-time"),
 *             @OA\Property(property="updated_at", type="string", format="date-time")
 *         )
 *     ),
 *     @OA\Response(
 *         response=401,
 *         description="Unauthorized - User not authenticated"
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="No alerts found for this symbol"
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Internal Server Error"
 *     )
 * )
 */
class GetSymbolAlertsAction
{
    public function __invoke(string $symbol): JsonResponse
    {
        $alerts = UserSymbolAlert::where([
            'symbol_id' => $symbol,
            'user_id' => request()->user()->id,
        ])->first();

        return response()->json($alerts);
    }
}
