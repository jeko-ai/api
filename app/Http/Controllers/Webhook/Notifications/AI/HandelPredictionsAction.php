<?php

namespace App\Http\Controllers\Webhook\Notifications\AI;

use App\Models\PricePredictionRequest;
use App\Notifications\PricePredictionRequestCompleted;
use App\Notifications\PricePredictionRequestFailed;
use App\Notifications\PricePredictionRequestPartiallyCompleted;
use F9Web\ApiResponseHelpers;

class HandelPredictionsAction
{
    use ApiResponseHelpers;

    public function __invoke(PricePredictionRequest $predictionRequest, string $type)
    {
        dump($type);
        switch ($type) {
            case 'partially_completed':
                $predictionRequest->user->notify(new PricePredictionRequestPartiallyCompleted($predictionRequest));
                break;
            case 'completed':
                $predictionRequest->user->notify(new PricePredictionRequestCompleted($predictionRequest));
                break;
            case 'failed':
                $predictionRequest->user->notify(new PricePredictionRequestFailed($predictionRequest));
                break;
        }
        return $this->respondOk('update received successfully');
    }
}
