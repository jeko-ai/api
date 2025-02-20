<?php

namespace App\Http\Controllers\API\V1\Markets;

use App\Models\Markets;
use Illuminate\Routing\Controller;

/**
 * @OA\Delete(
 *     path="/api/v1/markets/{id}",
 *     summary="Delete Markets",
 *     tags={"Markets"},
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
class DeleteMarkets extends Controller
{
    public function __invoke($id)
    {
        Markets::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}
