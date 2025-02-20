<?php

namespace App\Http\Controllers\API\V1\PortfolioHistory;

use App\Models\PortfolioHistory;
use Illuminate\Routing\Controller;

/**
 * @OA\Delete(
 *     path="/api/v1/portfoliohistory/{id}",
 *     summary="Delete PortfolioHistory",
 *     tags={"PortfolioHistory"},
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
class DeletePortfolioHistory extends Controller
{
    public function __invoke($id)
    {
        PortfolioHistory::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}
