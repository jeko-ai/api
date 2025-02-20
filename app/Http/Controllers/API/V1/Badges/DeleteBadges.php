<?php

namespace App\Http\Controllers\API\V1\Badges;

use App\Models\Badges;
use Illuminate\Routing\Controller;

/**
 * @OA\Delete(
 *     path="/v1/badges/{id}",
 *     summary="Delete Badges",
 *     tags={"Badges"},
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
class DeleteBadges extends Controller
{
    public function __invoke($id)
    {
        Badges::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}
