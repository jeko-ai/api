<?php

namespace App\Http\Controllers\API\V1\TradingSimulationRequests;

use App\Http\Resources\API\V1\TradingSimulationRequestsResource;
use App\Models\TradingSimulationRequests;
use Illuminate\Routing\Controller;

/**
 * @OA\Get(
 *     path="/api/v1/tradingsimulationrequests/{id}",
 *     summary="Get TradingSimulationRequests by ID",
 *     tags={"TradingSimulationRequests"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="string", format="uuid")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Successful",
 *         @OA\JsonContent(ref="#/components/schemas/TradingSimulationRequestsResource")
 *     )
 * )
 */
class GetTradingSimulationRequestsById extends Controller
{
    public function __invoke($id)
    {
        return new TradingSimulationRequestsResource(TradingSimulationRequests::findOrFail($id));
    }
}
