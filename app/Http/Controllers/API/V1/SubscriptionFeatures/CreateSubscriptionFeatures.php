<?php

namespace App\Http\Controllers\API\V1\SubscriptionFeatures;

use App\Http\Requests\API\V1\SubscriptionFeatures\CreateSubscriptionFeaturesRequest;
use App\Http\Resources\API\V1\SubscriptionFeaturesResource;
use App\Models\SubscriptionFeatures;
use Illuminate\Routing\Controller;

/**
 * @OA\Post(
 *     path="/v1/subscriptionfeatures",
 *     summary="Create a new SubscriptionFeatures",
 *     tags={"SubscriptionFeatures"},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(ref="#/components/schemas/CreateSubscriptionFeaturesRequest")
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Created",
 *         @OA\JsonContent(ref="#/components/schemas/SubscriptionFeaturesResource")
 *     )
 * )
 */
class CreateSubscriptionFeatures extends Controller
{
    public function __invoke(CreateSubscriptionFeaturesRequest $request)
    {
        $record = SubscriptionFeatures::create($request->validated());
        return new SubscriptionFeaturesResource($record);
    }
}
