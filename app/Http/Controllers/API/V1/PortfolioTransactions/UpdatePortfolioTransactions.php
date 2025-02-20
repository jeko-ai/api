<?php

namespace App\Http\Controllers\API\V1\PortfolioTransactions;

use App\Http\Requests\API\V1\PortfolioTransactions\UpdatePortfolioTransactionsRequest;
use App\Http\Resources\API\V1\PortfolioTransactionsResource;
use App\Models\PortfolioTransactions;
use Illuminate\Routing\Controller;

/**
 * @OA\Put(
 *     path="/v1/portfoliotransactions/{id}",
 *     summary="Update PortfolioTransactions",
 *     tags={"PortfolioTransactions"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="string", format="uuid")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(ref="#/components/schemas/UpdatePortfolioTransactionsRequest")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Updated",
 *         @OA\JsonContent(ref="#/components/schemas/PortfolioTransactionsResource")
 *     )
 * )
 */
class UpdatePortfolioTransactions extends Controller
{
    public function __invoke(UpdatePortfolioTransactionsRequest $request, $id)
    {
        $record = PortfolioTransactions::findOrFail($id);
        $record->update($request->validated());
        return new PortfolioTransactionsResource($record);
    }
}
