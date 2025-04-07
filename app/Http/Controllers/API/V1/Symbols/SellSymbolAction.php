<?php

namespace App\Http\Controllers\API\V1\Symbols;

use App\Http\Requests\SellSymbolRequest;
use App\Models\Portfolio;
use App\Models\PortfolioAsset;
use App\Models\PortfolioTransaction;
use Exception;
use Illuminate\Support\Facades\DB;

/**
 * @OA\Post(
 *     path="/v1/symbols/{symbol}/sell",
 *     summary="Sell a symbol from the user's portfolio",
 *     tags={"Symbols"},
 *     @OA\Parameter(
 *         name="symbol",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="string")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"id", "quantity", "sell_price", "sell_date"},
 *             @OA\Property(property="id", type="string", format="uuid", description="Symbol UUID"),
 *             @OA\Property(property="quantity", type="number", format="float", description="Quantity to sell", minimum=1),
 *             @OA\Property(property="sell_price", type="number", format="float", description="Selling price per unit", minimum=0),
 *             @OA\Property(property="sell_date", type="string", format="date", description="Date of sale")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Success",
 *         @OA\JsonContent(
 *             @OA\Property(property="status", type="string", example="success")
 *         )
 *     ),
 *     @OA\Response(
 *         response=400,
 *         description="Invalid symbol, portfolio, or insufficient shares",
 *         @OA\JsonContent(
 *             @OA\Property(property="status", type="string", example="error")
 *         )
 *     )
 * )
 */
class SellSymbolAction
{
    public function __invoke(SellSymbolRequest $request, string $symbol)
    {
        $userId = $request->user()->id;

        // Get user's default portfolio
        $userPortfolio = Portfolio::where('user_id', $userId)
            ->where('is_default', true)
            ->first();

        if (!$userPortfolio) {
            return response()->json(['status' => 'invalid_portfolio'], 400);
        }

        // Find the asset in the portfolio
        $existingAsset = PortfolioAsset::where('portfolio_id', $userPortfolio->id)
            ->where('symbol_id', $request->id)
            ->first();

        if (!$existingAsset) {
            return response()->json(['status' => 'invalid_symbol'], 400);
        }

        // Check if the user has enough shares to sell
        if ($existingAsset->quantity < $request->quantity) {
            return response()->json(['status' => 'insufficient_shares'], 400);
        }

        try {
            DB::transaction(function () use ($existingAsset, $request, $userPortfolio, $userId) {
                if ($existingAsset->quantity == $request->quantity) {
                    // Remove the asset if selling all shares
                    $existingAsset->delete();
                } else {
                    // Reduce the quantity
                    $existingAsset->update([
                        'quantity' => $existingAsset->quantity - $request->quantity,
                    ]);
                }

                // Insert transaction record
                PortfolioTransaction::create([
                    'portfolio_id' => $userPortfolio->id,
                    'symbol_id' => $request->id,
                    'user_id' => $userId,
                    'transaction_type' => 'sell',
                    'quantity' => $request->quantity,
                    'price_per_unit' => $request->sell_price,
                    'executed_at' => $request->sell_date,
                ]);
            });

            return response()->json(['status' => 'success']);
        } catch (Exception $e) {
            return response()->json(['status' => 'error'], 400);
        }
    }
}

