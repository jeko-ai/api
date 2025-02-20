<?php

namespace App\Http\Controllers\API\V1\MarketMoversGainers;

use App\Http\Requests\API\V1\MarketMoversGainers\UpdateMarketMoversGainersRequest;
use App\Http\Resources\API\V1\MarketMoversGainersResource;
use App\Models\MarketMoversGainers;
use Illuminate\Routing\Controller;

/**
 * @OA\Put(
 *     path="/v1/marketmoversgainers/{id}",
 *     summary="Update MarketMoversGainers",
 *     tags={"MarketMoversGainers"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="string", format="uuid")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(ref="#/components/schemas/UpdateMarketMoversGainersRequest")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Updated",
 *         @OA\JsonContent(ref="#/components/schemas/MarketMoversGainersResource")
 *     )
 * )
 */
class UpdateMarketMoversGainers extends Controller
{
    public function __invoke(UpdateMarketMoversGainersRequest $request, $id)
    {
        $record = MarketMoversGainers::findOrFail($id);
        $record->update($request->validated());
        return new MarketMoversGainersResource($record);
    }
}
