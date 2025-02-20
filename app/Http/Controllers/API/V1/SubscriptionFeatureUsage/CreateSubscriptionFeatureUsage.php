<?php

namespace App\Http\Controllers\API\V1\SubscriptionFeatureUsage;

use App\Http\Requests\API\V1\SubscriptionFeatureUsage\CreateSubscriptionFeatureUsageRequest;
use App\Http\Resources\API\V1\SubscriptionFeatureUsageResource;
use App\Models\SubscriptionFeatureUsage;
use Illuminate\Routing\Controller;

/**
 * @OA\Post(
 *     path="/v1/subscriptionfeatureusage",
 *     summary="Create a new SubscriptionFeatureUsage",
 *     tags={"SubscriptionFeatureUsage"},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(ref="#/components/schemas/CreateSubscriptionFeatureUsageRequest")
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Created",
 *         @OA\JsonContent(ref="#/components/schemas/SubscriptionFeatureUsageResource")
 *     )
 * )
 */
class CreateSubscriptionFeatureUsage extends Controller
{
    public function __invoke(CreateSubscriptionFeatureUsageRequest $request)
    {
        $record = SubscriptionFeatureUsage::create($request->validated());
        return new SubscriptionFeatureUsageResource($record);
    }
}
