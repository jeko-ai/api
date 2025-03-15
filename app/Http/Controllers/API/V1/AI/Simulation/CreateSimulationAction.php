<?php

namespace App\Http\Controllers\API\V1\AI\Simulation;

use App\Http\Requests\CreateSimulationRequest;
use App\Models\Market;
use App\Models\TradingSimulationRequest;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

class CreateSimulationAction
{
    public function __invoke(CreateSimulationRequest $request)
    {
        $markets = Cache::rememberForever('markets', function () {
            return Market::all();
        });

        $market = collect($markets)->keyBy('id')->get($request->market_id);

        TradingSimulationRequest::create([
            'user_id' => $request->user()->id,
            'market_id' => $request->market_id,
            'symbols' => $request->symbols,
            'sectors' => $request->sectors,
            'investment_amount' => $request->investment_amount,
            'risk_level' => $request->risk_level,
            'duration' => $request->duration,
            'strategy' => $request->strategy,
            'start_time' => Carbon::parse($request->start_time)->setTimeFromTimeString($market->open_at),
            'end_time' => Carbon::parse($request->end_time)->setTimeFromTimeString($market->close_at),
            'expected_return_percentage' => $request->expected_return_percentage,
            'stop_loss_percentage' => $request->stop_loss_percentage,
            'selected_type' => $request->selected_type,
        ]);
        return response()->json([]);

    }
}
