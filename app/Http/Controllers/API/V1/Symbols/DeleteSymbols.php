<?php

namespace App\Http\Controllers\API\V1\Symbols;

use App\Models\Symbols;
use Illuminate\Routing\Controller;

/**
 * @OA\Delete(
 *     path="/api/v1/symbols/{id}",
 *     summary="Delete Symbols",
 *     tags={"Symbols"},
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
class DeleteSymbols extends Controller
{
    public function __invoke($id)
    {
        Symbols::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}
