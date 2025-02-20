<?php

namespace App\Http\Controllers\API\V1\TradingSimulationRequests;

use App\Http\Requests\API\V1\TradingSimulationRequests\CreateTradingSimulationRequestsRequest;
use App\Http\Resources\API\V1\TradingSimulationRequestsResource;
use App\Models\TradingSimulationRequests;
use Illuminate\Routing\Controller;

/**
 * @OA\Post(
 *     path="/v1/tradingsimulationrequests",
 *     summary="Create a new TradingSimulationRequests",
 *     tags={"TradingSimulationRequests"},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(ref="#/components/schemas/CreateTradingSimulationRequestsRequest")
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Created",
 *         @OA\JsonContent(ref="#/components/schemas/TradingSimulationRequestsResource")
 *     )
 * )
 */
class CreateTradingSimulationRequests extends Controller
{
    public function __invoke(CreateTradingSimulationRequestsRequest $request)
    {
        $record = TradingSimulationRequests::create($request->validated());
        return new TradingSimulationRequestsResource($record);
    }
}
