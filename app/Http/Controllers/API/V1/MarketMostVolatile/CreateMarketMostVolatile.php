<?php

namespace App\Http\Controllers\API\V1\MarketMostVolatile;

use App\Http\Requests\API\V1\MarketMostVolatile\CreateMarketMostVolatileRequest;
use App\Http\Resources\API\V1\MarketMostVolatileResource;
use App\Models\MarketMostVolatile;
use Illuminate\Routing\Controller;

/**
 * @OA\Post(
 *     path="/api/v1/marketmostvolatile",
 *     summary="Create a new MarketMostVolatile",
 *     tags={"MarketMostVolatile"},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(ref="#/components/schemas/CreateMarketMostVolatileRequest")
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Created",
 *         @OA\JsonContent(ref="#/components/schemas/MarketMostVolatileResource")
 *     )
 * )
 */
class CreateMarketMostVolatile extends Controller
{
    public function __invoke(CreateMarketMostVolatileRequest $request)
    {
        $record = MarketMostVolatile::create($request->validated());
        return new MarketMostVolatileResource($record);
    }
}
