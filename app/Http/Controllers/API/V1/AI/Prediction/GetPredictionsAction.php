<?php

namespace App\Http\Controllers\API\V1\AI\Prediction;

use App\Models\PricePredictionRequest;

class GetPredictionsAction
{
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
