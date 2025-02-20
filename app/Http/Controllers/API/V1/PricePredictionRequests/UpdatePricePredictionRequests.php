<?php

namespace App\Http\Controllers\API\V1\PricePredictionRequests;

use App\Http\Requests\API\V1\PricePredictionRequests\UpdatePricePredictionRequestsRequest;
use App\Http\Resources\API\V1\PricePredictionRequestsResource;
use App\Models\PricePredictionRequests;
use Illuminate\Routing\Controller;

/**
 * @OA\Put(
 *     path="/v1/pricepredictionrequests/{id}",
 *     summary="Update PricePredictionRequests",
 *     tags={"PricePredictionRequests"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="string", format="uuid")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(ref="#/components/schemas/UpdatePricePredictionRequestsRequest")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Updated",
 *         @OA\JsonContent(ref="#/components/schemas/PricePredictionRequestsResource")
 *     )
 * )
 */
class UpdatePricePredictionRequests extends Controller
{
    public function __invoke(UpdatePricePredictionRequestsRequest $request, $id)
    {
        $record = PricePredictionRequests::findOrFail($id);
        $record->update($request->validated());
        return new PricePredictionRequestsResource($record);
    }
}
