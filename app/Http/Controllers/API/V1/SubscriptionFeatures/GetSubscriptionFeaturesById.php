<?php

namespace App\Http\Controllers\API\V1\SubscriptionFeatures;

use App\Http\Resources\API\V1\SubscriptionFeaturesResource;
use App\Models\SubscriptionFeatures;
use Illuminate\Routing\Controller;

/**
 * @OA\Get(
 *     path="/api/v1/subscriptionfeatures/{id}",
 *     summary="Get SubscriptionFeatures by ID",
 *     tags={"SubscriptionFeatures"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="string", format="uuid")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Successful",
 *         @OA\JsonContent(ref="#/components/schemas/SubscriptionFeaturesResource")
 *     )
 * )
 */
class GetSubscriptionFeaturesById extends Controller
{
    public function __invoke($id)
    {
        return new SubscriptionFeaturesResource(SubscriptionFeatures::findOrFail($id));
    }
}
