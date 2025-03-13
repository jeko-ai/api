<?php

namespace App\Http\Controllers\API\V1\AI\Simulation;

use App\Models\TradingSimulationRequests;

class GetSimulationAction
{
    public function __invoke()
    {
        return TradingSimulationRequests::where('user_id', request()->attributes->get('user_id'))->orderByDesc('created_at')->get();
    }
}
