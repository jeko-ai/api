<?php

namespace App\Http\Controllers\API\V1\AI\Prediction;

use App\Models\SymbolPricePrediction;
use Illuminate\Http\JsonResponse;

class GetSymbolPredictionAction
{
    public function __invoke($symbol): JsonResponse
    {
        $prediction = SymbolPricePrediction::where('symbol_id', $symbol)
            ->orderByDesc('prediction_date')
            ->first();
        return response()->json($prediction);
    }
}
