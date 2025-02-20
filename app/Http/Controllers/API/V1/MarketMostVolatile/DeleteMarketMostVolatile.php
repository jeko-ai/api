<?php

namespace App\Http\Controllers\API\V1\MarketMostVolatile;

use App\Models\MarketMostVolatile;
use Illuminate\Routing\Controller;

/**
 * @OA\Delete(
 *     path="/v1/marketmostvolatile/{id}",
 *     summary="Delete MarketMostVolatile",
 *     tags={"MarketMostVolatile"},
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
class DeleteMarketMostVolatile extends Controller
{
    public function __invoke($id)
    {
        MarketMostVolatile::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}
