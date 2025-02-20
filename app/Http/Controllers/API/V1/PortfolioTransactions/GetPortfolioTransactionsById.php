<?php

namespace App\Http\Controllers\API\V1\PortfolioTransactions;

use App\Http\Resources\API\V1\PortfolioTransactionsResource;
use App\Models\PortfolioTransactions;
use Illuminate\Routing\Controller;

/**
 * @OA\Get(
 *     path="/v1/portfoliotransactions/{id}",
 *     summary="Get PortfolioTransactions by ID",
 *     tags={"PortfolioTransactions"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="string", format="uuid")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Successful",
 *         @OA\JsonContent(ref="#/components/schemas/PortfolioTransactionsResource")
 *     )
 * )
 */
class GetPortfolioTransactionsById extends Controller
{
    public function __invoke($id)
    {
        return new PortfolioTransactionsResource(PortfolioTransactions::findOrFail($id));
    }
}
