<?php

namespace App\Http\Controllers\API\V1\MarketMoversActive;

use App\Http\Requests\API\V1\MarketMoversActive\UpdateMarketMoversActiveRequest;
use App\Http\Resources\API\V1\MarketMoversActiveResource;
use App\Models\MarketMoversActive;
use Illuminate\Routing\Controller;

/**
 * @OA\Put(
 *     path="/v1/marketmoversactive/{id}",
 *     summary="Update MarketMoversActive",
 *     tags={"MarketMoversActive"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="string", format="uuid")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(ref="#/components/schemas/UpdateMarketMoversActiveRequest")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Updated",
 *         @OA\JsonContent(ref="#/components/schemas/MarketMoversActiveResource")
 *     )
 * )
 */
class UpdateMarketMoversActive extends Controller
{
    public function __invoke(UpdateMarketMoversActiveRequest $request, $id)
    {
        $record = MarketMoversActive::findOrFail($id);
        $record->update($request->validated());
        return new MarketMoversActiveResource($record);
    }
}
