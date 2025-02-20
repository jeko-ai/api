<?php

namespace App\Http\Controllers\API\V1\MarketMoversLosers;

use App\Models\MarketMoversLosers;
use Illuminate\Routing\Controller;

/**
 * @OA\Delete(
 *     path="/v1/marketmoverslosers/{id}",
 *     summary="Delete MarketMoversLosers",
 *     tags={"MarketMoversLosers"},
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
class DeleteMarketMoversLosers extends Controller
{
    public function __invoke($id)
    {
        MarketMoversLosers::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}
