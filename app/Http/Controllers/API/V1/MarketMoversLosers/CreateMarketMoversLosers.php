<?php

namespace App\Http\Controllers\API\V1\MarketMoversLosers;

use App\Http\Requests\API\V1\MarketMoversLosers\CreateMarketMoversLosersRequest;
use App\Http\Resources\API\V1\MarketMoversLosersResource;
use App\Models\MarketMoversLosers;
use Illuminate\Routing\Controller;

/**
 * @OA\Post(
 *     path="/v1/marketmoverslosers",
 *     summary="Create a new MarketMoversLosers",
 *     tags={"MarketMoversLosers"},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(ref="#/components/schemas/CreateMarketMoversLosersRequest")
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Created",
 *         @OA\JsonContent(ref="#/components/schemas/MarketMoversLosersResource")
 *     )
 * )
 */
class CreateMarketMoversLosers extends Controller
{
    public function __invoke(CreateMarketMoversLosersRequest $request)
    {
        $record = MarketMoversLosers::create($request->validated());
        return new MarketMoversLosersResource($record);
    }
}
