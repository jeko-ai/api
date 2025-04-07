<?php

namespace App\Http\Controllers\API\V1\Symbols;

use App\Http\Requests\BuySymbolRequest;
use App\Models\Portfolio;
use App\Models\PortfolioAsset;
use App\Models\PortfolioTransaction;
use Exception;
use Illuminate\Support\Facades\DB;

/**
 * @OA\Post(
 *     path="/v1/symbols/{symbol}/buy",
 *     summary="Buy a symbol and add it to the user's portfolio",
 *     tags={"Symbols"},
 *     @OA\Parameter(
 *         name="symbol",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="string")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(ref="#/components/schemas/BuySymbolRequest")
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
 *         description="Invalid portfolio or error",
 *         @OA\JsonContent(
 *             @OA\Property(property="status", type="string", example="error")
 *         )
 *     )
 * )
 */
class BuySymbolAction
{
    public function __invoke(BuySymbolRequest $request, string $symbol)
    {
        $userId = $request->user()->id;

        // Get user's default portfolio
        $userPortfolio = Portfolio::where('user_id', $userId)
            ->where('is_default', true)
            ->first();

        if (!$userPortfolio) {
            return response()->json(['status' => 'invalid_portfolio'], 400);
        }

        try {
            DB::transaction(function () use ($request, $userPortfolio, $userId) {
                // Check if the asset exists in the portfolio
                $existingAsset = PortfolioAsset::where('portfolio_id', $userPortfolio->id)
                    ->where('symbol_id', $request->id)
                    ->first();

                if ($existingAsset) {
                    // Update quantity and avg buy price
                    $newQuantity = $existingAsset->quantity + $request->quantity;
                    $newAvgPrice = (($existingAsset->avg_buy_price * $existingAsset->quantity) +
                            ($request->price_per_unit * $request->quantity)) / $newQuantity;

                    $existingAsset->update([
                        'quantity' => $newQuantity,
                        'avg_buy_price' => $newAvgPrice,
                        'buy_date' => $request->buy_date,
                    ]);
                } else {
                    // Insert new asset
                    PortfolioAsset::create([
                        'portfolio_id' => $userPortfolio->id,
                        'symbol_id' => $request->id,
                        'user_id' => $userId,
                        'quantity' => $request->quantity,
                        'avg_buy_price' => $request->price_per_unit,
                        'buy_date' => $request->buy_date,
                    ]);
                }

                // Insert transaction record
                PortfolioTransaction::create([
                    'portfolio_id' => $userPortfolio->id,
                    'symbol_id' => $request->id,
                    'user_id' => $userId,
                    'transaction_type' => 'buy',
                    'quantity' => $request->quantity,
                    'price_per_unit' => $request->price_per_unit,
                    'executed_at' => $request->buy_date,
                ]);
            });

            return response()->json(['status' => 'success']);
        } catch (Exception $e) {
            return response()->json(['status' => 'error'], 400);
        }
    }
}

