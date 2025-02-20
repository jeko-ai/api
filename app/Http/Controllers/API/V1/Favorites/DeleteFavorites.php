<?php

namespace App\Http\Controllers\API\V1\Favorites;

use App\Models\Favorites;
use Illuminate\Routing\Controller;

/**
 * @OA\Delete(
 *     path="/api/v1/favorites/{id}",
 *     summary="Delete Favorites",
 *     tags={"Favorites"},
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
class DeleteFavorites extends Controller
{
    public function __invoke($id)
    {
        Favorites::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}
