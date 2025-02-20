<?php

namespace App\Http\Controllers\API\V1\MarketMostVolatile;

use App\Http\Requests\API\V1\MarketMostVolatile\UpdateMarketMostVolatileRequest;
use App\Http\Resources\API\V1\MarketMostVolatileResource;
use App\Models\MarketMostVolatile;
use Illuminate\Routing\Controller;

/**
 * @OA\Put(
 *     path="/api/v1/marketmostvolatile/{id}",
 *     summary="Update MarketMostVolatile",
 *     tags={"MarketMostVolatile"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="string", format="uuid")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(ref="#/components/schemas/UpdateMarketMostVolatileRequest")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Updated",
 *         @OA\JsonContent(ref="#/components/schemas/MarketMostVolatileResource")
 *     )
 * )
 */
class UpdateMarketMostVolatile extends Controller
{
    public function __invoke(UpdateMarketMostVolatileRequest $request, $id)
    {
        $record = MarketMostVolatile::findOrFail($id);
        $record->update($request->validated());
        return new MarketMostVolatileResource($record);
    }
}
