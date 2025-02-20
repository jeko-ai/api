<?php

namespace App\Http\Controllers\API\V1\MarketMoversGainers;

use App\Http\Resources\API\V1\MarketMoversGainersResource;
use App\Models\MarketMoversGainers;
use Illuminate\Routing\Controller;

/**
 * @OA\Get(
 *     path="/v1/marketmoversgainers/{id}",
 *     summary="Get MarketMoversGainers by ID",
 *     tags={"MarketMoversGainers"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="string", format="uuid")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Successful",
 *         @OA\JsonContent(ref="#/components/schemas/MarketMoversGainersResource")
 *     )
 * )
 */
class GetMarketMoversGainersById extends Controller
{
    public function __invoke($id)
    {
        return new MarketMoversGainersResource(MarketMoversGainers::findOrFail($id));
    }
}
