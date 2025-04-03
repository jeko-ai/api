<?php

namespace App\Http\Controllers\Webhook\Notifications\AI;

use App\Models\TradingSimulationRequest;
use F9Web\ApiResponseHelpers;

class HandelSimulationsAction
{
    use ApiResponseHelpers;

    public function __invoke(TradingSimulationRequest $tradingSimulationRequest, string $type)
    {
        // TODO: Implement __invoke() method.
    }
}
