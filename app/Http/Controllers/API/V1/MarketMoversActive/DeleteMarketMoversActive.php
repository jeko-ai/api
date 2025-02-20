<?php

namespace App\Http\Controllers\API\V1\MarketMoversActive;

use App\Models\MarketMoversActive;
use Illuminate\Routing\Controller;

/**
 * @OA\Delete(
 *     path="/api/v1/marketmoversactive/{id}",
 *     summary="Delete MarketMoversActive",
 *     tags={"MarketMoversActive"},
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
class DeleteMarketMoversActive extends Controller
{
    public function __invoke($id)
    {
        MarketMoversActive::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}
