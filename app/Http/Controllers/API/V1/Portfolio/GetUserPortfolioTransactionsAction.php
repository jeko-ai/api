<?php

namespace App\Http\Controllers\API\V1\Portfolio;

use App\Models\Portfolio;
use App\Models\PortfolioTransaction;

/**
 * @OA\Get(
 *     path="/v1/portfolio/transactions",
 *     operationId="getUserPortfolioTransactions",
 *     tags={"Portfolio"},
 *     summary="Get transactions in user's default portfolio",
 *     description="Returns a list of transactions for the user's default portfolio",
 *     security={{"bearerAuth":{}}},
 *     @OA\Response(
 *         response=200,
 *         description="Successful operation",
 *         @OA\JsonContent(
 *             type="array",
 *             @OA\Items(
 *                 @OA\Property(property="id", type="integer"),
 *                 @OA\Property(property="portfolio_id", type="integer"),
 *                 @OA\Property(property="symbol_id", type="integer"),
 *                 @OA\Property(property="transaction_type", type="string", enum={"buy", "sell"}),
 *                 @OA\Property(property="quantity", type="number", format="float"),
 *                 @OA\Property(property="price", type="number", format="float"),
 *                 @OA\Property(property="transaction_date", type="string", format="date-time"),
 *                 @OA\Property(property="created_at", type="string", format="date-time"),
 *                 @OA\Property(property="updated_at", type="string", format="date-time"),
 *                 @OA\Property(
 *                     property="symbol",
 *                     type="object",
 *                     @OA\Property(property="id", type="integer"),
 *                     @OA\Property(property="logo_id", type="integer"),
 *                     @OA\Property(property="name_ar", type="string"),
 *                     @OA\Property(property="name_en", type="string"),
 *                     @OA\Property(property="symbol", type="string"),
 *                     @OA\Property(property="currency", type="string"),
 *                     @OA\Property(property="quote", type="object")
 *                 )
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=401,
 *         description="Unauthenticated"
 *     )
 * )
 */
class GetUserPortfolioTransactionsAction
{
    public function __invoke()
    {
        $latestPortfolio = Portfolio::where('user_id', request()->user()->id)
            ->where('is_default', true)
            ->orderBy('created_at', 'desc')
            ->first();

        $transactions = PortfolioTransaction::where('portfolio_id', $latestPortfolio->id)->with([
            'symbol' => function ($query) {
                $query->select([
                    'id', 'logo_id', 'name_ar', 'name_en', 'symbol', 'currency'
                ])->with('quote');
            },
        ])
            ->get();

        return response()->json($transactions);
    }
}

