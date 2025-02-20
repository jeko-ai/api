<?php

namespace App\Http\Controllers\API\V1\PortfolioAssets;

use App\Http\Requests\API\V1\PortfolioAssets\UpdatePortfolioAssetsRequest;
use App\Http\Resources\API\V1\PortfolioAssetsResource;
use App\Models\PortfolioAssets;
use Illuminate\Routing\Controller;

/**
 * @OA\Put(
 *     path="/v1/portfolioassets/{id}",
 *     summary="Update PortfolioAssets",
 *     tags={"PortfolioAssets"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="string", format="uuid")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(ref="#/components/schemas/UpdatePortfolioAssetsRequest")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Updated",
 *         @OA\JsonContent(ref="#/components/schemas/PortfolioAssetsResource")
 *     )
 * )
 */
class UpdatePortfolioAssets extends Controller
{
    public function __invoke(UpdatePortfolioAssetsRequest $request, $id)
    {
        $record = PortfolioAssets::findOrFail($id);
        $record->update($request->validated());
        return new PortfolioAssetsResource($record);
    }
}
