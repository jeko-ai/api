<?php

namespace App\Http\Controllers\API\V1\AI\Simulation;

use App\Jobs\NotifyBrainAboutNewRequestJob;
use App\Models\TradingSimulationRequest;
use Illuminate\Support\Facades\Cache;

class GetSimulationAction
{
    public function __invoke(string $id)
    {
        $cacheKey = "simulation_{$id}";

        // Check if the simulation is in the cache
        $simulation = Cache::get($cacheKey);

        if (!$simulation) {
            // Retrieve the simulation from the database
            $simulation = TradingSimulationRequest::with('transactions')->where('user_id', auth()->user()->id)->find($id);

            if (request()->has('retry') && request('retry')) {
                $simulation->status = 'pending';
                $simulation->save();
                // Notify Brain about the new simulation request
                NotifyBrainAboutNewRequestJob::dispatch(TradingSimulationRequest::class);
            }
            // Cache the simulation if the status is "completed"
            if ($simulation && $simulation->status === 'completed') {
                Cache::put($cacheKey, $simulation, now()->addMinutes(60)); // Cache for 60 minutes
            }
        }

        return response()->json($simulation);
    }
}

