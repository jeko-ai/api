<?php

namespace App\Http\Controllers\API\V1\MarketMostVolatile;

use App\Http\Resources\API\V1\MarketMostVolatileResource;
use App\Models\MarketMostVolatile;
use Illuminate\Routing\Controller;

/**
 * @OA\Get(
 *     path="/api/v1/marketmostvolatile/{id}",
 *     summary="Get MarketMostVolatile by ID",
 *     tags={"MarketMostVolatile"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="string", format="uuid")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Successful",
 *         @OA\JsonContent(ref="#/components/schemas/MarketMostVolatileResource")
 *     )
 * )
 */
class GetMarketMostVolatileById extends Controller
{
    public function __invoke($id)
    {
        return new MarketMostVolatileResource(MarketMostVolatile::findOrFail($id));
    }
}
