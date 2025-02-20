<?php

namespace App\Http\Controllers\API\V1\MarketMoversActive;

use App\Http\Requests\API\V1\MarketMoversActive\CreateMarketMoversActiveRequest;
use App\Http\Resources\API\V1\MarketMoversActiveResource;
use App\Models\MarketMoversActive;
use Illuminate\Routing\Controller;

/**
 * @OA\Post(
 *     path="/v1/marketmoversactive",
 *     summary="Create a new MarketMoversActive",
 *     tags={"MarketMoversActive"},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(ref="#/components/schemas/CreateMarketMoversActiveRequest")
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Created",
 *         @OA\JsonContent(ref="#/components/schemas/MarketMoversActiveResource")
 *     )
 * )
 */
class CreateMarketMoversActive extends Controller
{
    public function __invoke(CreateMarketMoversActiveRequest $request)
    {
        $record = MarketMoversActive::create($request->validated());
        return new MarketMoversActiveResource($record);
    }
}
