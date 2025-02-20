<?php

namespace App\Http\Controllers\API\V1\SubscriptionFeatures;

use App\Models\SubscriptionFeatures;
use Illuminate\Routing\Controller;

/**
 * @OA\Delete(
 *     path="/api/v1/subscriptionfeatures/{id}",
 *     summary="Delete SubscriptionFeatures",
 *     tags={"SubscriptionFeatures"},
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
class DeleteSubscriptionFeatures extends Controller
{
    public function __invoke($id)
    {
        SubscriptionFeatures::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}
