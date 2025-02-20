<?php

namespace App\Http\Controllers\API\V1\Subscriptions;

use App\Models\Subscriptions;
use Illuminate\Routing\Controller;

/**
 * @OA\Delete(
 *     path="/v1/subscriptions/{id}",
 *     summary="Delete Subscriptions",
 *     tags={"Subscriptions"},
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
class DeleteSubscriptions extends Controller
{
    public function __invoke($id)
    {
        Subscriptions::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}
