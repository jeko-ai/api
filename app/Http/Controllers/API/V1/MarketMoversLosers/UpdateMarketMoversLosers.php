<?php

namespace App\Http\Controllers\API\V1\MarketMoversLosers;

use App\Http\Requests\API\V1\MarketMoversLosers\UpdateMarketMoversLosersRequest;
use App\Http\Resources\API\V1\MarketMoversLosersResource;
use App\Models\MarketMoversLosers;
use Illuminate\Routing\Controller;

/**
 * @OA\Put(
 *     path="/v1/marketmoverslosers/{id}",
 *     summary="Update MarketMoversLosers",
 *     tags={"MarketMoversLosers"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="string", format="uuid")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(ref="#/components/schemas/UpdateMarketMoversLosersRequest")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Updated",
 *         @OA\JsonContent(ref="#/components/schemas/MarketMoversLosersResource")
 *     )
 * )
 */
class UpdateMarketMoversLosers extends Controller
{
    public function __invoke(UpdateMarketMoversLosersRequest $request, $id)
    {
        $record = MarketMoversLosers::findOrFail($id);
        $record->update($request->validated());
        return new MarketMoversLosersResource($record);
    }
}
