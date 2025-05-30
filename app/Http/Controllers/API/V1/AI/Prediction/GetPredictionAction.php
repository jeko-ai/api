<?php

namespace App\Http\Controllers\API\V1\AI\Prediction;

use App\Jobs\NotifyBrainAboutNewRequestJob;
use App\Models\PricePredictionRequest;
use Illuminate\Support\Facades\Cache;

class GetPredictionAction
{
    public function __invoke(string $id)
    {
        $cacheKey = "prediction_{$id}";

        // Check if the prediction is in the cache
        $prediction = Cache::get($cacheKey);

        if (!$prediction) {
            // Retrieve the prediction from the database
            $prediction = PricePredictionRequest::with('results')->where('user_id', auth()->user()->id)->find($id);

            if (request()->has('retry') && request('retry')) {
                $prediction->status = 'pending';
                $prediction->save();
                // Notify Brain about the new prediction request
                NotifyBrainAboutNewRequestJob::dispatch(PricePredictionRequest::class);
            }

            // Cache the prediction if the status is "completed"
            if ($prediction && $prediction->status === 'completed') {
                Cache::put($cacheKey, $prediction, now()->addMinutes(60)); // Cache for 60 minutes
            }
        }

        return response()->json($prediction);
    }
}

