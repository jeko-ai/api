<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Requests\UpdateUserSettingsRequest;
use Illuminate\Support\Facades\DB;

class UpdateUserSettingsAction
{
    public function __invoke(UpdateUserSettingsRequest $request)
    {
        $data = DB::selectOne('
    SELECT * FROM update_user_profile(
        :full_name,
        :language,
        :risk_level,
        :country_id,
        :is_notification_enabled,
        :is_price_alerts_enabled,
        :is_new_recommendations_alerts_enabled,
        :is_portfolio_update_alerts_enabled,
        :is_market_sentiment_alerts_enabled
    )
', [
            'full_name' => $request->input('full_name', null),
            'language' => $request->input('language', null),
            'risk_level' => $request->input('risk_level', null),
            'country_id' => $request->input('country_id', null),
            'is_notification_enabled' => $request->input('is_notification_enabled', null),
            'is_price_alerts_enabled' => $request->input('is_price_alerts_enabled', null),
            'is_new_recommendations_alerts_enabled' => $request->input('is_new_recommendations_alerts_enabled', null),
            'is_portfolio_update_alerts_enabled' => $request->input('is_portfolio_update_alerts_enabled', null),
            'is_market_sentiment_alerts_enabled' => $request->input('is_market_sentiment_alerts_enabled', null),
        ]);

        return response()->json($data);
    }
}
