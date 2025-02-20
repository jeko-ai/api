<?php

namespace App\Http\Controllers\API\V1\MarketMoversLosers;

use App\Http\Resources\API\V1\MarketMoversLosersResource;
use App\Models\MarketMoversLosers;
use Illuminate\Routing\Controller;

/**
 * @OA\Get(
 *     path="/v1/marketmoverslosers/{id}",
 *     summary="Get MarketMoversLosers by ID",
 *     tags={"MarketMoversLosers"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="string", format="uuid")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Successful",
 *         @OA\JsonContent(ref="#/components/schemas/MarketMoversLosersResource")
 *     )
 * )
 */
class GetMarketMoversLosersById extends Controller
{
    public function __invoke($id)
    {
        return new MarketMoversLosersResource(MarketMoversLosers::findOrFail($id));
    }
}
