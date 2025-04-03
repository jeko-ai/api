<?php

namespace App\Http\Controllers\Webhook\Notifications\AI;

use App\Models\PricePredictionRequest;
use App\Notifications\PricePredictionRequestStatusUpdated;
use F9Web\ApiResponseHelpers;

class HandelPredictionsAction
{
    use ApiResponseHelpers;

    public function __invoke(PricePredictionRequest $id, string $type)
    {
        $id->user->notify(new PricePredictionRequestStatusUpdated($id));
        return $this->respondOk('update received successfully');
    }
}
