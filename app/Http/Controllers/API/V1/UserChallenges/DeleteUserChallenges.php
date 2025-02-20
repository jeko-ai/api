<?php

namespace App\Http\Controllers\API\V1\UserChallenges;

use App\Models\UserChallenges;
use Illuminate\Routing\Controller;

/**
 * @OA\Delete(
 *     path="/api/v1/userchallenges/{id}",
 *     summary="Delete UserChallenges",
 *     tags={"UserChallenges"},
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
class DeleteUserChallenges extends Controller
{
    public function __invoke($id)
    {
        UserChallenges::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}
