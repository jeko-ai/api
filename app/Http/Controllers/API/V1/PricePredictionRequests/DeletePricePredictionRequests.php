<?php

namespace App\Http\Controllers\API\V1\PricePredictionRequests;

use App\Models\PricePredictionRequests;
use Illuminate\Routing\Controller;

/**
 * @OA\Delete(
 *     path="/api/v1/pricepredictionrequests/{id}",
 *     summary="Delete PricePredictionRequests",
 *     tags={"PricePredictionRequests"},
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
class DeletePricePredictionRequests extends Controller
{
    public function __invoke($id)
    {
        PricePredictionRequests::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}
