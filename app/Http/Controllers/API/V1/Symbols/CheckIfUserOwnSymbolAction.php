<?php

namespace App\Http\Controllers\API\V1\Symbols;

use App\Models\Portfolio;
use App\Models\PortfolioAsset;

class CheckIfUserOwnSymbolAction
{
    public function __invoke(string $symbol)
    {
        $userId = request()->user()->id;

        // Get the user's default portfolio
        $userPortfolio = Portfolio::where('user_id', $userId)
            ->where('is_default', true)
            ->first();

        if (!$userPortfolio) {
            return response()->json(['owned' => false]);
        }

        // Check if the symbol exists in portfolio_assets
        $symbolOwned = PortfolioAsset::where('portfolio_id', $userPortfolio->id)
            ->where('symbol_id', $symbol)
            ->exists();

        return response()->json(['owned' => $symbolOwned]);
    }
}
