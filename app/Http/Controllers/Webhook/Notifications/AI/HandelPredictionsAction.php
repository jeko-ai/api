<?php

namespace App\Http\Controllers\Webhook\Notifications\AI;

use App\Models\PricePredictionRequest;
use F9Web\ApiResponseHelpers;

class HandelPredictionsAction
{
    use ApiResponseHelpers;

    public function __invoke(PricePredictionRequest $predictionRequest, string $type)
    {
        // TODO: Implement __invoke() method.
    }
}
