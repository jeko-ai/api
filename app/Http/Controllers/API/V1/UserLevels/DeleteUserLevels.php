<?php

namespace App\Http\Controllers\API\V1\UserLevels;

use App\Models\UserLevels;
use Illuminate\Routing\Controller;

/**
 * @OA\Delete(
 *     path="/api/v1/userlevels/{id}",
 *     summary="Delete UserLevels",
 *     tags={"UserLevels"},
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
class DeleteUserLevels extends Controller
{
    public function __invoke($id)
    {
        UserLevels::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}
