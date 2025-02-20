<?php

namespace App\Http\Controllers\API\V1\PortfolioAssets;

use App\Models\PortfolioAssets;
use Illuminate\Routing\Controller;

/**
 * @OA\Delete(
 *     path="/v1/portfolioassets/{id}",
 *     summary="Delete PortfolioAssets",
 *     tags={"PortfolioAssets"},
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
class DeletePortfolioAssets extends Controller
{
    public function __invoke($id)
    {
        PortfolioAssets::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}
