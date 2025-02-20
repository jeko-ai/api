<?php

namespace App\Http\Controllers\API\V1\Quotes;

use App\Models\Quotes;
use Illuminate\Routing\Controller;

/**
 * @OA\Delete(
 *     path="/api/v1/quotes/{id}",
 *     summary="Delete Quotes",
 *     tags={"Quotes"},
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
class DeleteQuotes extends Controller
{
    public function __invoke($id)
    {
        Quotes::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}
