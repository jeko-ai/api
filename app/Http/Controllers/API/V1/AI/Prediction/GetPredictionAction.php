<?php

namespace App\Http\Controllers\API\V1\AI\Prediction;

use App\Models\PricePredictionRequests;

class GetPredictionAction
{
    public function __invoke(string $id)
    {
        $prediction = PricePredictionRequests::find($id);
        return response()->json($prediction);
    }
}
