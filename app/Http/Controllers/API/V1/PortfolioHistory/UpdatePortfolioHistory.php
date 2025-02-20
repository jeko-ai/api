<?php

namespace App\Http\Controllers\API\V1\PortfolioHistory;

use App\Http\Requests\API\V1\PortfolioHistory\UpdatePortfolioHistoryRequest;
use App\Http\Resources\API\V1\PortfolioHistoryResource;
use App\Models\PortfolioHistory;
use Illuminate\Routing\Controller;

/**
 * @OA\Put(
 *     path="/v1/portfoliohistory/{id}",
 *     summary="Update PortfolioHistory",
 *     tags={"PortfolioHistory"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="string", format="uuid")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(ref="#/components/schemas/UpdatePortfolioHistoryRequest")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Updated",
 *         @OA\JsonContent(ref="#/components/schemas/PortfolioHistoryResource")
 *     )
 * )
 */
class UpdatePortfolioHistory extends Controller
{
    public function __invoke(UpdatePortfolioHistoryRequest $request, $id)
    {
        $record = PortfolioHistory::findOrFail($id);
        $record->update($request->validated());
        return new PortfolioHistoryResource($record);
    }
}
