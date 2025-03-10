<?php

namespace App\Http\Controllers\API\V1\AI\Prediction;

use App\Models\SymbolPricePrediction;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;

class GetSymbolPredictionAction
{
    public function __invoke($symbol): JsonResponse
    {
        try {
            $prediction = Cache::remember("prediction-$symbol", 5 * 60, function () use ($symbol) {
                return SymbolPricePrediction::where('symbol_id', $symbol)
                    ->orderByDesc('prediction_date')
                    ->first();
            });

            return response()->json($prediction);
        } catch (Exception $exception) {
            return response()->json(['error' => ''], 400);
        }
    }
}
