<?php

namespace App\Http\Controllers\API\V1\AI\Simulation;

use App\Models\TradingSimulationRequest;

/**
 * @OA\Get(
 *     path="/api/v1/ai/simulations",
 *     operationId="getSimulations",
 *     tags={"AI Simulations"},
 *     summary="Get all simulations",
 *     description="Retrieve all trading simulations for the authenticated user",
 *     security={{"bearerAuth":{}}},
 *     @OA\Response(
 *         response=200,
 *         description="List of simulations",
 *         @OA\JsonContent(
 *             type="array",
 *             @OA\Items(
 *                 @OA\Property(property="id", type="integer", example=1),
 *                 @OA\Property(property="user_id", type="integer", example=1),
 *                 @OA\Property(property="market_id", type="integer", example=1),
 *                 @OA\Property(property="status", type="string", example="completed"),
 *                 @OA\Property(property="created_at", type="string", format="date-time")
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=401,
 *         description="Unauthorized"
 *     )
 * )
 */
class GetSimulationsAction
{
    public function __invoke()
    {
        return TradingSimulationRequest::where('user_id', request()->user()->id)
            ->select([
                'id',
                'user_id',
                'market_id',
                'status',
                'created_at',
            ])->orderByDesc('created_at')->get();
    }
}

