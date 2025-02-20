<?php

namespace App\Http\Controllers\API\V1\SymbolPrices;

use App\Models\SymbolPrices;
use Illuminate\Routing\Controller;

/**
 * @OA\Delete(
 *     path="/api/v1/symbolprices/{id}",
 *     summary="Delete SymbolPrices",
 *     tags={"SymbolPrices"},
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
class DeleteSymbolPrices extends Controller
{
    public function __invoke($id)
    {
        SymbolPrices::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}
