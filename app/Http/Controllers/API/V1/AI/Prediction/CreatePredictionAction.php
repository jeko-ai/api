<?php

namespace App\Http\Controllers\API\V1\AI\Prediction;

use App\Http\Requests\API\V1\CreatePredictionRequest;
use App\Models\PricePredictionRequests;
use App\Models\Symbols;
use Illuminate\Support\Facades\Cache;

class CreatePredictionAction
{
    public function __invoke(CreatePredictionRequest $request)
    {
        $symbols = Cache::rememberForever('symbols', function () {
            return Symbols::where('type', 'stock')->get();
        });
        $symbol = collect($symbols)->keyBy('id')->get($request->id);
        PricePredictionRequests::create([
            'user_id' => $user->id,
            'symbol_id' => $symbol?->id,
            'symbol' => $symbol?->symbol,
            'market_id' => $symbol?->market_id,
            'prediction_type' => $request->prediction_type,
            'prediction_start_date' => $request->prediction_start_date,
            'prediction_end_date' => $request->prediction_end_date,
        ]);
        return response()->json([]);
    }
}
