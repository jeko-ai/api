<?php

namespace App\Http\Controllers\API\V1\PortfolioTransactions;

use App\Http\Requests\API\V1\PortfolioTransactions\CreatePortfolioTransactionsRequest;
use App\Http\Resources\API\V1\PortfolioTransactionsResource;
use App\Models\PortfolioTransactions;
use Illuminate\Routing\Controller;

/**
 * @OA\Post(
 *     path="/v1/portfoliotransactions",
 *     summary="Create a new PortfolioTransactions",
 *     tags={"PortfolioTransactions"},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(ref="#/components/schemas/CreatePortfolioTransactionsRequest")
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Created",
 *         @OA\JsonContent(ref="#/components/schemas/PortfolioTransactionsResource")
 *     )
 * )
 */
class CreatePortfolioTransactions extends Controller
{
    public function __invoke(CreatePortfolioTransactionsRequest $request)
    {
        $record = PortfolioTransactions::create($request->validated());
        return new PortfolioTransactionsResource($record);
    }
}
