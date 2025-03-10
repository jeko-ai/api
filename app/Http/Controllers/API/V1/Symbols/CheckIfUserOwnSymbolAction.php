<?php

namespace App\Http\Controllers\API\V1\Symbols;

use App\Models\PortfolioAssets;
use App\Models\Portfolios;

class CheckIfUserOwnSymbolAction
{
    public function __invoke(string $symbol)
    {
        $user = request()->attributes->get('user_id');

        // Get the user's default portfolio
        $userPortfolio = Portfolios::where('user_id', $user->id)
            ->where('is_default', true)
            ->first();

        if (!$userPortfolio) {
            return response()->json(['owned' => false]);
        }

        // Check if the symbol exists in portfolio_assets
        $symbolOwned = PortfolioAssets::where('portfolio_id', $userPortfolio->id)
            ->where('symbol_id', $symbol)
            ->exists();

        return response()->json(['owned' => $symbolOwned]);
    }
}
