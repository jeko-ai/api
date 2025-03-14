<?php

namespace App\Http\Controllers\API\V1\AI\Simulation;

use App\Models\TradingSimulationRequest;

class GetSimulationsAction
{
    public function __invoke()
    {
        return TradingSimulationRequest::where('user_id', request()->user()->id)->orderByDesc('created_at')->get();
    }
}
