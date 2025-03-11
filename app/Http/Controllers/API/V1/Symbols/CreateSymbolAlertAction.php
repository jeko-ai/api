<?php

namespace App\Http\Controllers\API\V1\Symbols;

use App\Http\Requests\CreateSymbolAlertRequest;
use App\Models\Symbols;
use App\Models\UserSymbolAlert;
use Illuminate\Http\JsonResponse;

/**
 * @OA\Post(
 *     path="/v1/symbols/{symbol}/alerts",
 *     summary="Create or update symbol alerts for the authenticated user",
 *     description="Creates or updates alert settings for a specific symbol for the authenticated user",
 *     tags={"symbols"},
 *     security={"supabase_auth": {}},
 *     @OA\Parameter(
 *         name="symbol",
 *         in="path",
 *         required=true,
 *         description="Symbol ID in the URL path (not used, use id in request body instead)",
 *         @OA\Schema(type="string")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"id"},
 *             @OA\Property(property="id", type="string", format="uuid", description="Symbol ID to create/update alerts for"),
 *             @OA\Property(property="enable_price_alert", type="boolean", description="Enable price alerts for this symbol"),
 *             @OA\Property(property="price_alert", type="number", description="Price threshold for alert"),
 *             @OA\Property(property="new_recommendation", type="boolean", description="Alert on new recommendations"),
 *             @OA\Property(property="latest_news", type="boolean", description="Alert on latest news"),
 *             @OA\Property(property="new_predictions", type="boolean", description="Alert on new predictions"),
 *             @OA\Property(property="unusual_volume_alert", type="boolean", description="Alert on unusual volume"),
 *             @OA\Property(property="volatility_alert", type="boolean", description="Alert on volatility changes"),
 *             @OA\Property(property="earnings_report_alert", type="boolean", description="Alert on earnings reports"),
 *             @OA\Property(property="analyst_rating_alert", type="boolean", description="Alert on analyst rating changes"),
 *             @OA\Property(property="corporate_events_alert", type="boolean", description="Alert on corporate events"),
 *             @OA\Property(property="market_movement_alert", type="boolean", description="Alert on market movements"),
 *             @OA\Property(property="ai_smart_alert", type="boolean", description="Enable AI-powered smart alerts")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Symbol alerts created or updated successfully",
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
 *         response=400,
 *         description="Invalid symbol ID",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="error", type="string", example="invalid_symbol")
 *         )
 *     ),
 *     @OA\Response(
 *         response=401,
 *         description="Unauthorized - User not authenticated"
 *     ),
 *     @OA\Response(
 *         response=422,
 *         description="Validation error",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="message", type="string", example="The given data was invalid."),
 *             @OA\Property(property="errors", type="object")
 *         )
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Internal Server Error"
 *     )
 * )
 */
class CreateSymbolAlertAction
{
    public function __invoke(CreateSymbolAlertRequest $request, string $symbol): JsonResponse
    {
        $userId = $request->attributes->get('user_id');

        $symbolId = $request->input('id');

        // Fetch symbol details
        $symbol = Symbols::select('inv_id', 'tv_id')->where('id', $symbolId)->first();
        if (!$symbol) {
            return response()->json(['error' => 'invalid_symbol'], 400);
        }

        // Check for existing alert
        $alert = UserSymbolAlert::where('user_id', $userId)->where('symbol_id', $symbolId)->first();

        if ($alert) {
            $alert->update([
                'inv_id' => $symbol->inv_id,
                'tv_id' => $symbol->tv_id,
                'enable_price_alert' => $request->input('enable_price_alert', $alert->enable_price_alert),
                'price_alert' => $request->input('price_alert', $alert->price_alert),
                'new_recommendation' => $request->input('new_recommendation', $alert->new_recommendation),
                'latest_news' => $request->input('latest_news', $alert->latest_news),
                'new_predictions' => $request->input('new_predictions', $alert->new_predictions),
                'unusual_volume_alert' => $request->input('unusual_volume_alert', $alert->unusual_volume_alert),
                'volatility_alert' => $request->input('volatility_alert', $alert->volatility_alert),
                'earnings_report_alert' => $request->input('earnings_report_alert', $alert->earnings_report_alert),
                'analyst_rating_alert' => $request->input('analyst_rating_alert', $alert->analyst_rating_alert),
                'corporate_events_alert' => $request->input('corporate_events_alert', $alert->corporate_events_alert),
                'market_movement_alert' => $request->input('market_movement_alert', $alert->market_movement_alert),
                'ai_smart_alert' => $request->input('ai_smart_alert', $alert->ai_smart_alert),
                'updated_at' => now()
            ]);
        } else {
            $alert = UserSymbolAlert::create([
                'user_id' => $userId,
                'symbol_id' => $symbolId,
                'inv_id' => $symbol->inv_id,
                'tv_id' => $symbol->tv_id,
                'enable_price_alert' => $request->input('enable_price_alert', false),
                'price_alert' => $request->input('price_alert', null),
                'new_recommendation' => $request->input('new_recommendation', false),
                'latest_news' => $request->input('latest_news', false),
                'new_predictions' => $request->input('new_predictions', false),
                'unusual_volume_alert' => $request->input('unusual_volume_alert', false),
                'volatility_alert' => $request->input('volatility_alert', false),
                'earnings_report_alert' => $request->input('earnings_report_alert', false),
                'analyst_rating_alert' => $request->input('analyst_rating_alert', false),
                'corporate_events_alert' => $request->input('corporate_events_alert', false),
                'market_movement_alert' => $request->input('market_movement_alert', false),
                'ai_smart_alert' => $request->input('ai_smart_alert', false),
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

        return response()->json($alert);
    }
}
