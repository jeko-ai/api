<?php

namespace App\Http\Controllers\API\V1\Symbols;

use App\Http\Requests\AddSymbolToPortfolioRequest;
use App\Models\Portfolio;
use App\Models\PortfolioAssets;
use App\Models\PortfolioTransactions;
use App\Models\Symbols;
use DB;

class AddSymbolToPortfolioAction
{
    public function __invoke(AddSymbolToPortfolioRequest $request, string $symbol)
    {
        $userId = $request->attributes->get('user_id');
        $symbolId = $request->id;
        $quantity = $request->quantity;
        $avgBuyPrice = $request->avg_buy_price;
        $buyDate = $request->buy_date;

        // Check if the symbol exists
        if (!Symbols::where('id', $symbolId)->exists()) {
            return response()->json(['status' => 'invalid_symbol'], 400);
        }

        // Retrieve the user's default portfolio
        $userPortfolio = Portfolio::where('user_id', $userId)
            ->where('is_default', true)
            ->first();

        if (!$userPortfolio) {
            return response()->json(['status' => 'invalid_portfolio'], 400);
        }

        $portfolioId = $userPortfolio->id;

        return DB::transaction(function () use ($portfolioId, $symbolId, $userId, $quantity, $avgBuyPrice, $buyDate) {
            // Check if the asset already exists in the portfolio
            $existingAsset = PortfolioAssets::where('portfolio_id', $portfolioId)
                ->where('symbol_id', $symbolId)
                ->first();

            if ($existingAsset) {
                // Update existing asset
                $newQuantity = $existingAsset->quantity + $quantity;
                $newAvgPrice = (($existingAsset->avg_buy_price * $existingAsset->quantity) + ($avgBuyPrice * $quantity)) / $newQuantity;

                $existingAsset->update([
                    'quantity' => $newQuantity,
                    'avg_buy_price' => $newAvgPrice,
                    'buy_date' => $buyDate,
                ]);
            } else {
                // Insert new asset
                PortfolioAssets::create([
                    'portfolio_id' => $portfolioId,
                    'symbol_id' => $symbolId,
                    'user_id' => $userId,
                    'quantity' => $quantity,
                    'avg_buy_price' => $avgBuyPrice,
                    'buy_date' => $buyDate,
                    'created_at' => now(),
                ]);
            }

            // Log the transaction
            PortfolioTransactions::create([
                'portfolio_id' => $portfolioId,
                'symbol_id' => $symbolId,
                'user_id' => $userId,
                'transaction_type' => 'buy',
                'quantity' => $quantity,
                'price_per_unit' => $avgBuyPrice,
                'executed_at' => $buyDate,
            ]);

            return response()->json(['status' => 'success']);
        }, 5); // Retry up to 5 times if a deadlock occurs
    }
}
