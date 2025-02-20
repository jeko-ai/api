<?php

namespace App\Http\Controllers\API\V1\Rewards;

use App\Models\Rewards;
use Illuminate\Routing\Controller;

/**
 * @OA\Delete(
 *     path="/v1/rewards/{id}",
 *     summary="Delete Rewards",
 *     tags={"Rewards"},
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
class DeleteRewards extends Controller
{
    public function __invoke($id)
    {
        Rewards::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}
