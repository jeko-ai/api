<?php

namespace App\Http\Controllers\API\V1\Sectors;

use App\Models\Sectors;
use Illuminate\Routing\Controller;

/**
 * @OA\Delete(
 *     path="/v1/sectors/{id}",
 *     summary="Delete Sectors",
 *     tags={"Sectors"},
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
class DeleteSectors extends Controller
{
    public function __invoke($id)
    {
        Sectors::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}
