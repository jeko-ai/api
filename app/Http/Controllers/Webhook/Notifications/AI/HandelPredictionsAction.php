<?php

namespace App\Http\Controllers\Webhook\Notifications\AI;

use App\Models\PricePredictionRequest;
use App\Notifications\PricePredictionRequestStatusUpdated;
use F9Web\ApiResponseHelpers;

class HandelPredictionsAction
{
    use ApiResponseHelpers;

    public function __invoke(PricePredictionRequest $predictionRequest, string $type)
    {
        $predictionRequest->user->notify(new PricePredictionRequestStatusUpdated($predictionRequest));
        return $this->respondOk('update received successfully');
    }
}
