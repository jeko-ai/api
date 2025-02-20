<?php

namespace App\Http\Controllers\API\V1\PricePredictionRequests;

use App\Http\Resources\API\V1\PricePredictionRequestsResource;
use App\Models\PricePredictionRequests;
use Illuminate\Routing\Controller;

/**
 * @OA\Get(
 *     path="/api/v1/pricepredictionrequests/{id}",
 *     summary="Get PricePredictionRequests by ID",
 *     tags={"PricePredictionRequests"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="string", format="uuid")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Successful",
 *         @OA\JsonContent(ref="#/components/schemas/PricePredictionRequestsResource")
 *     )
 * )
 */
class GetPricePredictionRequestsById extends Controller
{
    public function __invoke($id)
    {
        return new PricePredictionRequestsResource(PricePredictionRequests::findOrFail($id));
    }
}
