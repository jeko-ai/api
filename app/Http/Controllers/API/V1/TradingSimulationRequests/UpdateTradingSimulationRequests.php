<?php

namespace App\Http\Controllers\API\V1\TradingSimulationRequests;

use App\Http\Requests\API\V1\TradingSimulationRequests\UpdateTradingSimulationRequestsRequest;
use App\Http\Resources\API\V1\TradingSimulationRequestsResource;
use App\Models\TradingSimulationRequests;
use Illuminate\Routing\Controller;

/**
 * @OA\Put(
 *     path="/v1/tradingsimulationrequests/{id}",
 *     summary="Update TradingSimulationRequests",
 *     tags={"TradingSimulationRequests"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="string", format="uuid")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(ref="#/components/schemas/UpdateTradingSimulationRequestsRequest")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Updated",
 *         @OA\JsonContent(ref="#/components/schemas/TradingSimulationRequestsResource")
 *     )
 * )
 */
class UpdateTradingSimulationRequests extends Controller
{
    public function __invoke(UpdateTradingSimulationRequestsRequest $request, $id)
    {
        $record = TradingSimulationRequests::findOrFail($id);
        $record->update($request->validated());
        return new TradingSimulationRequestsResource($record);
    }
}
