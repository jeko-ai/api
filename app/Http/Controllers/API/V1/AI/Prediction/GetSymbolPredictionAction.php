<?php

namespace App\Http\Controllers\API\V1\AI\Prediction;

use App\Models\SymbolPricePrediction;
use Illuminate\Support\Facades\Cache;

class GetSymbolPredictionAction
{
    public function __invoke($symbol)
    {
        return Cache::remember("prediction-$symbol", 5 * 60, function () use ($symbol) {
            return SymbolPricePrediction::where('symbol_id', $symbol)
                ->orderByDesc('prediction_date')
                ->first();
        });
    }
}
