<?php

namespace App\Http\Controllers\Webhook\Notifications\AI;

use App\Jobs\ProcessPricePredictionRequestNotification;
use App\Models\PricePredictionRequest;
use F9Web\ApiResponseHelpers;

class HandelPredictionsAction
{
    use ApiResponseHelpers;

    public function __invoke(PricePredictionRequest $id, string $type)
    {
        ProcessPricePredictionRequestNotification::dispatch($id, $type);
        return $this->respondOk('update received successfully');
    }
}
