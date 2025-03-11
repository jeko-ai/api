<?php

namespace App\Http\Controllers\API\V1\Portfolio;

use App\Models\PortfolioAssets;
use App\Models\Portfolios;

class GetUserPortfolioAssetsAction
{
    public function __invoke()
    {
        $latestPortfolio = Portfolios::where('user_id', request()->attributes->get('user_id'))
            ->where('is_default', true)
            ->orderBy('created_at', 'desc')
            ->first();

        $assets = PortfolioAssets::where('portfolio_id', $latestPortfolio->id)->get();

        return response()->json($assets);
    }
}
