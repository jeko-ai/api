<?php

namespace App\Http\Controllers\API\V1\SubscriptionFeatureUsage;

use App\Models\SubscriptionFeatureUsage;
use Illuminate\Routing\Controller;

/**
 * @OA\Delete(
 *     path="/api/v1/subscriptionfeatureusage/{id}",
 *     summary="Delete SubscriptionFeatureUsage",
 *     tags={"SubscriptionFeatureUsage"},
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
class DeleteSubscriptionFeatureUsage extends Controller
{
    public function __invoke($id)
    {
        SubscriptionFeatureUsage::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}
