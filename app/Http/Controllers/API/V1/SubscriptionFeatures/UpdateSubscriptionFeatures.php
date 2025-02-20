<?php

namespace App\Http\Controllers\API\V1\SubscriptionFeatures;

use App\Http\Requests\API\V1\SubscriptionFeatures\UpdateSubscriptionFeaturesRequest;
use App\Http\Resources\API\V1\SubscriptionFeaturesResource;
use App\Models\SubscriptionFeatures;
use Illuminate\Routing\Controller;

/**
 * @OA\Put(
 *     path="/api/v1/subscriptionfeatures/{id}",
 *     summary="Update SubscriptionFeatures",
 *     tags={"SubscriptionFeatures"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="string", format="uuid")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(ref="#/components/schemas/UpdateSubscriptionFeaturesRequest")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Updated",
 *         @OA\JsonContent(ref="#/components/schemas/SubscriptionFeaturesResource")
 *     )
 * )
 */
class UpdateSubscriptionFeatures extends Controller
{
    public function __invoke(UpdateSubscriptionFeaturesRequest $request, $id)
    {
        $record = SubscriptionFeatures::findOrFail($id);
        $record->update($request->validated());
        return new SubscriptionFeaturesResource($record);
    }
}
