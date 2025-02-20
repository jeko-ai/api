<?php

namespace App\Http\Controllers\API\V1\PortfolioHistory;

use App\Http\Resources\API\V1\PortfolioHistoryResource;
use App\Models\PortfolioHistory;
use Illuminate\Routing\Controller;

/**
 * @OA\Get(
 *     path="/api/v1/portfoliohistory/{id}",
 *     summary="Get PortfolioHistory by ID",
 *     tags={"PortfolioHistory"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="string", format="uuid")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Successful",
 *         @OA\JsonContent(ref="#/components/schemas/PortfolioHistoryResource")
 *     )
 * )
 */
class GetPortfolioHistoryById extends Controller
{
    public function __invoke($id)
    {
        return new PortfolioHistoryResource(PortfolioHistory::findOrFail($id));
    }
}
