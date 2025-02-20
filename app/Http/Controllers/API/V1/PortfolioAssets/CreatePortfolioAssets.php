<?php

namespace App\Http\Controllers\API\V1\PortfolioAssets;

use App\Http\Requests\API\V1\PortfolioAssets\CreatePortfolioAssetsRequest;
use App\Http\Resources\API\V1\PortfolioAssetsResource;
use App\Models\PortfolioAssets;
use Illuminate\Routing\Controller;

/**
 * @OA\Post(
 *     path="/v1/portfolioassets",
 *     summary="Create a new PortfolioAssets",
 *     tags={"PortfolioAssets"},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(ref="#/components/schemas/CreatePortfolioAssetsRequest")
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Created",
 *         @OA\JsonContent(ref="#/components/schemas/PortfolioAssetsResource")
 *     )
 * )
 */
class CreatePortfolioAssets extends Controller
{
    public function __invoke(CreatePortfolioAssetsRequest $request)
    {
        $record = PortfolioAssets::create($request->validated());
        return new PortfolioAssetsResource($record);
    }
}
