<?php

namespace App\Http\Controllers\API\V1\MarketMoversActive;

use App\Http\Resources\API\V1\MarketMoversActiveResource;
use App\Models\MarketMoversActive;
use Illuminate\Routing\Controller;

/**
 * @OA\Get(
 *     path="/api/v1/marketmoversactive/{id}",
 *     summary="Get MarketMoversActive by ID",
 *     tags={"MarketMoversActive"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="string", format="uuid")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Successful",
 *         @OA\JsonContent(ref="#/components/schemas/MarketMoversActiveResource")
 *     )
 * )
 */
class GetMarketMoversActiveById extends Controller
{
    public function __invoke($id)
    {
        return new MarketMoversActiveResource(MarketMoversActive::findOrFail($id));
    }
}
