<?php

namespace App\Http\Controllers\API\V1\PortfolioAssets;

use App\Http\Resources\API\V1\PortfolioAssetsResource;
use App\Models\PortfolioAssets;
use Illuminate\Routing\Controller;

/**
 * @OA\Get(
 *     path="/api/v1/portfolioassets/{id}",
 *     summary="Get PortfolioAssets by ID",
 *     tags={"PortfolioAssets"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="string", format="uuid")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Successful",
 *         @OA\JsonContent(ref="#/components/schemas/PortfolioAssetsResource")
 *     )
 * )
 */
class GetPortfolioAssetsById extends Controller
{
    public function __invoke($id)
    {
        return new PortfolioAssetsResource(PortfolioAssets::findOrFail($id));
    }
}
