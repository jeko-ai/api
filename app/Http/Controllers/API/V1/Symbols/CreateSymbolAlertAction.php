<?php

namespace App\Http\Controllers\API\V1\Symbols;

use App\Http\Requests\CreateSymbolAlertRequest;
use App\Models\Symbol;
use App\Models\UserSymbolAlert;
use Illuminate\Http\JsonResponse;

class CreateSymbolAlertAction
{
    public function __invoke(CreateSymbolAlertRequest $request, string $symbol): JsonResponse
    {
        $userId = $request->user()->id;

        $symbolId = $request->input('id');

        // Fetch symbol details
        $symbol = Symbol::select('inv_id', 'tv_id')->where('id', $symbolId)->first();
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
