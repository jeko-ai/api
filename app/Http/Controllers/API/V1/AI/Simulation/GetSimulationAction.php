<?php

namespace App\Http\Controllers\API\V1\AI\Simulation;

use App\Models\TradingSimulationRequest;
use Illuminate\Support\Facades\Cache;

/**
 * @OA\Get(
 *     path="/api/v1/ai/simulations/{id}",
 *     operationId="getSimulation",
 *     tags={"simulations"},
 *     summary="Get a specific simulation",
 *     description="Retrieve details of a specific trading simulation",
 *     security={{"bearerAuth":{}}},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Simulation ID",
 *         @OA\Schema(type="string")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Simulation details",
 *         @OA\JsonContent(
 *             @OA\Property(property="id", type="integer", example=1),
 *             @OA\Property(property="user_id", type="integer", example=1),
 *             @OA\Property(property="market_id", type="integer", example=1),
 *             @OA\Property(property="status", type="string", example="completed"),
 *             @OA\Property(property="investment_amount", type="number", format="float", example=10000),
 *             @OA\Property(property="risk_level", type="string", example="medium"),
 *             @OA\Property(property="duration", type="integer", example=30),
 *             @OA\Property(property="strategy", type="string", example="growth"),
 *             @OA\Property(property="start_time", type="string", format="date-time"),
 *             @OA\Property(property="end_time", type="string", format="date-time"),
 *             @OA\Property(property="created_at", type="string", format="date-time"),
 *             @OA\Property(property="transactions", type="array", @OA\Items(
 *                 @OA\Property(property="id", type="integer"),
 *                 @OA\Property(property="symbol", type="string"),
 *                 @OA\Property(property="type", type="string"),
 *                 @OA\Property(property="price", type="number", format="float"),
 *                 @OA\Property(property="quantity", type="number"),
 *                 @OA\Property(property="date", type="string", format="date-time")
 *             ))
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Simulation not found"
 *     ),
 *     @OA\Response(
 *         response=401,
 *         description="Unauthorized"
 *     )
 * )
 */
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

            // Cache the simulation if the status is "completed"
            if ($simulation && $simulation->status === 'completed') {
                Cache::put($cacheKey, $simulation, now()->addMinutes(60)); // Cache for 60 minutes
            }
        }

        return response()->json($simulation);
    }
}

