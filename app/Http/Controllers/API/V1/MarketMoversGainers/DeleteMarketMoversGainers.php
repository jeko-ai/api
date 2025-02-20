<?php

namespace App\Http\Controllers\API\V1\MarketMoversGainers;

use App\Models\MarketMoversGainers;
use Illuminate\Routing\Controller;

/**
 * @OA\Delete(
 *     path="/api/v1/marketmoversgainers/{id}",
 *     summary="Delete MarketMoversGainers",
 *     tags={"MarketMoversGainers"},
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
class DeleteMarketMoversGainers extends Controller
{
    public function __invoke($id)
    {
        MarketMoversGainers::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}
