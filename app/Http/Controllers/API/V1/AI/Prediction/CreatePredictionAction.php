<?php

namespace App\Http\Controllers\API\V1\AI\Prediction;

use App\Http\Requests\API\V1\CreatePredictionRequest;
use App\Models\PricePredictionRequests;
use App\Models\Symbols;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

class CreatePredictionAction
{
    public function __invoke(CreatePredictionRequest $request)
    {
        $symbols = Cache::rememberForever('symbols', function () {
            return Symbols::where('type', 'stock')->get();
        });
        $symbol = collect($symbols)->keyBy('id')->get($request->id);
        $market = $symbol?->market;
        dd($market->open_at, $market->close_at);
        PricePredictionRequests::create([
            'user_id' => $request->attributes->get('user_id'),
            'symbol_id' => $symbol?->id,
            'symbol' => $symbol?->symbol,
            'market_id' => $symbol?->market_id,
            'prediction_type' => $request->prediction_type,
            'prediction_start_date' => Carbon::parse($request->prediction_start_date)->setTime($market->open_at),
            'prediction_end_date' => Carbon::parse($request->prediction_end_date)->setTime($market->close_at),
        ]);
        return response()->json([]);
    }
}
