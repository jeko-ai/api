<?php

namespace App\Http\Controllers\API\V1\Recommendations;

use App\Models\Recommendations;
use Illuminate\Routing\Controller;

/**
 * @OA\Delete(
 *     path="/api/v1/recommendations/{id}",
 *     summary="Delete Recommendations",
 *     tags={"Recommendations"},
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
class DeleteRecommendations extends Controller
{
    public function __invoke($id)
    {
        Recommendations::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}
