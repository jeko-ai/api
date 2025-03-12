<?php

namespace App\Http\Controllers\API\V1\AI\Prediction;

use App\Models\PricePredictionRequests;

class GetPredictionsAction
{
    public function __invoke()
    {
        return PricePredictionRequests::where('user_id', request()->attributes->get('user_id'))
            ->select([
                'id',
                'user_id',
                'symbol_id',
                'symbol',
                'market_id',
                'prediction_type',
                'request_date',
                'prediction_start_date',
                'prediction_end_date',
                'status',
            ])
            ->orderByDesc('created_at')
            ->get();
    }
}
