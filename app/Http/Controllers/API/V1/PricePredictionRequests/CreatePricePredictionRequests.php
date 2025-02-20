<?php

namespace App\Http\Controllers\API\V1\PricePredictionRequests;

use App\Http\Requests\API\V1\PricePredictionRequests\CreatePricePredictionRequestsRequest;
use App\Http\Resources\API\V1\PricePredictionRequestsResource;
use App\Models\PricePredictionRequests;
use Illuminate\Routing\Controller;

/**
 * @OA\Post(
 *     path="/v1/pricepredictionrequests",
 *     summary="Create a new PricePredictionRequests",
 *     tags={"PricePredictionRequests"},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(ref="#/components/schemas/CreatePricePredictionRequestsRequest")
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Created",
 *         @OA\JsonContent(ref="#/components/schemas/PricePredictionRequestsResource")
 *     )
 * )
 */
class CreatePricePredictionRequests extends Controller
{
    public function __invoke(CreatePricePredictionRequestsRequest $request)
    {
        $record = PricePredictionRequests::create($request->validated());
        return new PricePredictionRequestsResource($record);
    }
}
