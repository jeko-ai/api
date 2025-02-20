<?php

namespace App\Http\Controllers\API\V1\SubscriptionFeatureUsage;

use App\Http\Resources\API\V1\SubscriptionFeatureUsageResource;
use App\Models\SubscriptionFeatureUsage;
use Illuminate\Routing\Controller;

/**
 * @OA\Get(
 *     path="/api/v1/subscriptionfeatureusage/{id}",
 *     summary="Get SubscriptionFeatureUsage by ID",
 *     tags={"SubscriptionFeatureUsage"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="string", format="uuid")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Successful",
 *         @OA\JsonContent(ref="#/components/schemas/SubscriptionFeatureUsageResource")
 *     )
 * )
 */
class GetSubscriptionFeatureUsageById extends Controller
{
    public function __invoke($id)
    {
        return new SubscriptionFeatureUsageResource(SubscriptionFeatureUsage::findOrFail($id));
    }
}
