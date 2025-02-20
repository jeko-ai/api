<?php

namespace App\Http\Controllers\API\V1\PortfolioHistory;

use App\Http\Requests\API\V1\PortfolioHistory\CreatePortfolioHistoryRequest;
use App\Http\Resources\API\V1\PortfolioHistoryResource;
use App\Models\PortfolioHistory;
use Illuminate\Routing\Controller;

/**
 * @OA\Post(
 *     path="/api/v1/portfoliohistory",
 *     summary="Create a new PortfolioHistory",
 *     tags={"PortfolioHistory"},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(ref="#/components/schemas/CreatePortfolioHistoryRequest")
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Created",
 *         @OA\JsonContent(ref="#/components/schemas/PortfolioHistoryResource")
 *     )
 * )
 */
class CreatePortfolioHistory extends Controller
{
    public function __invoke(CreatePortfolioHistoryRequest $request)
    {
        $record = PortfolioHistory::create($request->validated());
        return new PortfolioHistoryResource($record);
    }
}
