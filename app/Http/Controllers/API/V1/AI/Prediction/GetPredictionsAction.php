<?php

namespace App\Http\Controllers\API\V1\AI\Prediction;

use App\Models\PricePredictionRequests;

class GetPredictionsAction
{
    public function __invoke()
    {
        return PricePredictionRequests::where('user_id', request()->attributes->get('user_id'))->orderByDesc('created_at')->get();
    }
}
