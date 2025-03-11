<?php

namespace App\Http\Controllers\API\V1\Symbols;

use App\Models\PortfolioTransactions;
use Illuminate\Http\JsonResponse;

/**
 * @OA\Get(
 *     path="/v1/symbols/{symbol}/transactions",
 *     summary="Get symbol transactions",
 *     description="Retrieves all transactions for a specific symbol ordered by execution date",
 *     tags={"symbols"},
 *     security={"supabase_auth": {}},
 *     @OA\Parameter(
 *         name="symbol",
 *         in="path",
 *         required=true,
 *         description="Symbol ID to retrieve transactions for",
 *         @OA\Schema(type="string")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Symbol transactions retrieved successfully",
 *         @OA\JsonContent(
 *             type="array",
 *             @OA\Items(
 *                 type="object",
 *                 @OA\Property(property="id", type="string", format="uuid"),
 *                 @OA\Property(property="portfolio_id", type="string"),
 *                 @OA\Property(property="symbol_id", type="string"),
 *                 @OA\Property(property="type", type="string", example="buy", description="Transaction type: buy or sell"),
 *                 @OA\Property(property="quantity", type="number", example=10),
 *                 @OA\Property(property="price", type="number", example=150.75),
 *                 @OA\Property(property="total", type="number", example=1507.50),
 *                 @OA\Property(property="executed_at", type="string", format="date-time"),
 *                 @OA\Property(property="created_at", type="string", format="date-time"),
 *                 @OA\Property(property="updated_at", type="string", format="date-time")
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=401,
 *         description="Unauthorized - User not authenticated"
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="No transactions found for this symbol"
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Internal Server Error"
 *     )
 * )
 */
class GetSymbolTransactionsAction
{
    public function __invoke(string $symbol): JsonResponse
    {
        // Get transactions for the symbol
        $transactions = PortfolioTransactions::where('symbol_id', $symbol)
            ->orderByDesc('executed_at')
            ->get();

        return response()->json($transactions);
    }
}
