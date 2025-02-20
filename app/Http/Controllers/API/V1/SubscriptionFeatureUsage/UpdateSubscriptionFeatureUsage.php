<?php

namespace App\Http\Controllers\API\V1\SubscriptionFeatureUsage;

use App\Http\Requests\API\V1\SubscriptionFeatureUsage\UpdateSubscriptionFeatureUsageRequest;
use App\Http\Resources\API\V1\SubscriptionFeatureUsageResource;
use App\Models\SubscriptionFeatureUsage;
use Illuminate\Routing\Controller;

/**
 * @OA\Put(
 *     path="/api/v1/subscriptionfeatureusage/{id}",
 *     summary="Update SubscriptionFeatureUsage",
 *     tags={"SubscriptionFeatureUsage"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="string", format="uuid")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(ref="#/components/schemas/UpdateSubscriptionFeatureUsageRequest")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Updated",
 *         @OA\JsonContent(ref="#/components/schemas/SubscriptionFeatureUsageResource")
 *     )
 * )
 */
class UpdateSubscriptionFeatureUsage extends Controller
{
    public function __invoke(UpdateSubscriptionFeatureUsageRequest $request, $id)
    {
        $record = SubscriptionFeatureUsage::findOrFail($id);
        $record->update($request->validated());
        return new SubscriptionFeatureUsageResource($record);
    }
}
