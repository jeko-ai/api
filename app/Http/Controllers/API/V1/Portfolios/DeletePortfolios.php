<?php

namespace App\Http\Controllers\API\V1\Portfolios;

use App\Models\Portfolios;
use Illuminate\Routing\Controller;

/**
 * @OA\Delete(
 *     path="/v1/portfolios/{id}",
 *     summary="Delete Portfolios",
 *     tags={"Portfolios"},
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
class DeletePortfolios extends Controller
{
    public function __invoke($id)
    {
        Portfolios::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}
