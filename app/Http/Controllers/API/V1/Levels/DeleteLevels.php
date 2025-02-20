<?php

namespace App\Http\Controllers\API\V1\Levels;

use App\Models\Levels;
use Illuminate\Routing\Controller;

/**
 * @OA\Delete(
 *     path="/v1/levels/{id}",
 *     summary="Delete Levels",
 *     tags={"Levels"},
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
class DeleteLevels extends Controller
{
    public function __invoke($id)
    {
        Levels::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}
