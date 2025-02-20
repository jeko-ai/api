<?php

namespace App\Http\Controllers\API\V1\UserBadges;

use App\Models\UserBadges;
use Illuminate\Routing\Controller;

/**
 * @OA\Delete(
 *     path="/v1/userbadges/{id}",
 *     summary="Delete UserBadges",
 *     tags={"UserBadges"},
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
class DeleteUserBadges extends Controller
{
    public function __invoke($id)
    {
        UserBadges::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}
