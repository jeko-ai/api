<?php

namespace App\Http\Controllers\API\V1\Symbols;

use App\Http\Requests\BuySymbolRequest;
use App\Models\Portfolio;
use App\Models\PortfolioAssets;
use App\Models\PortfolioTransactions;
use Exception;
use Illuminate\Support\Facades\DB;

class BuySymbolAction
{
    public function __invoke(BuySymbolRequest $request, string $symbol)
    {
        $userId = $request->attributes->get('user_id');

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
                $existingAsset = PortfolioAssets::where('portfolio_id', $userPortfolio->id)
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
                    PortfolioAssets::create([
                        'portfolio_id' => $userPortfolio->id,
                        'symbol_id' => $request->id,
                        'user_id' => $userId,
                        'quantity' => $request->quantity,
                        'avg_buy_price' => $request->price_per_unit,
                        'buy_date' => $request->buy_date,
                    ]);
                }

                // Insert transaction record
                PortfolioTransactions::create([
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
