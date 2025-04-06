<?php

namespace App\Http\Controllers\Webhook\Notifications\AI;

use App\Jobs\ProcessTradingSimulationRequestNotification;
use App\Models\TradingSimulationRequest;
use F9Web\ApiResponseHelpers;

class HandelSimulationsAction
{
    use ApiResponseHelpers;

    public function __invoke(TradingSimulationRequest $id, string $type)
    {
        ProcessTradingSimulationRequestNotification::dispatch($id, $type);
        return $this->respondOk('update received successfully');
    }
}
