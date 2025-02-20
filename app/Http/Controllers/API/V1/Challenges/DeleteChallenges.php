<?php

namespace App\Http\Controllers\API\V1\Challenges;

use App\Models\Challenges;
use Illuminate\Routing\Controller;

/**
 * @OA\Delete(
 *     path="/v1/challenges/{id}",
 *     summary="Delete Challenges",
 *     tags={"Challenges"},
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
class DeleteChallenges extends Controller
{
    public function __invoke($id)
    {
        Challenges::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}
