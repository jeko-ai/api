<?php

namespace App\Http\Controllers\API\V1\News;

use App\Models\News;
use Illuminate\Routing\Controller;

/**
 * @OA\Delete(
 *     path="/v1/news/{id}",
 *     summary="Delete News",
 *     tags={"News"},
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
class DeleteNews extends Controller
{
    public function __invoke($id)
    {
        News::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}
