<?php

namespace App\Http\Controllers\API\V1\TradingSimulationRequests;

use App\Models\TradingSimulationRequests;
use Illuminate\Routing\Controller;

/**
 * @OA\Delete(
 *     path="/api/v1/tradingsimulationrequests/{id}",
 *     summary="Delete TradingSimulationRequests",
 *     tags={"TradingSimulationRequests"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="string", format="uuid")
 *     ),
 *     @OA\Response(
 *         response=204,
 *         description="Deleted"
 *     )
 * )
 */
class DeleteTradingSimulationRequests extends Controller
{
    public function __invoke($id)
    {
        TradingSimulationRequests::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}
