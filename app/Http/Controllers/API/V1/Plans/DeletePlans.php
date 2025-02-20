<?php

namespace App\Http\Controllers\API\V1\Plans;

use App\Models\Plans;
use Illuminate\Routing\Controller;

/**
 * @OA\Delete(
 *     path="/api/v1/plans/{id}",
 *     summary="Delete Plans",
 *     tags={"Plans"},
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
class DeletePlans extends Controller
{
    public function __invoke($id)
    {
        Plans::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}
