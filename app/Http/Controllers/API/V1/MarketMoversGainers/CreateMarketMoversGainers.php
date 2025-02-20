<?php

namespace App\Http\Controllers\API\V1\MarketMoversGainers;

use App\Http\Requests\API\V1\MarketMoversGainers\CreateMarketMoversGainersRequest;
use App\Http\Resources\API\V1\MarketMoversGainersResource;
use App\Models\MarketMoversGainers;
use Illuminate\Routing\Controller;

/**
 * @OA\Post(
 *     path="/v1/marketmoversgainers",
 *     summary="Create a new MarketMoversGainers",
 *     tags={"MarketMoversGainers"},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(ref="#/components/schemas/CreateMarketMoversGainersRequest")
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Created",
 *         @OA\JsonContent(ref="#/components/schemas/MarketMoversGainersResource")
 *     )
 * )
 */
class CreateMarketMoversGainers extends Controller
{
    public function __invoke(CreateMarketMoversGainersRequest $request)
    {
        $record = MarketMoversGainers::create($request->validated());
        return new MarketMoversGainersResource($record);
    }
}
