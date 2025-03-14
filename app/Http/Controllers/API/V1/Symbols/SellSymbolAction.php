<?php

namespace App\Http\Controllers\API\V1\Symbols;

use App\Http\Requests\SellSymbolRequest;
use App\Models\Portfolio;
use App\Models\PortfolioAsset;
use App\Models\PortfolioTransaction;
use Exception;
use Illuminate\Support\Facades\DB;

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
