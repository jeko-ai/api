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

        $assets = PortfolioAssets::where('portfolio_id', $latestPortfolio->id)->with([
            'symbol' => function ($query) {
                $query->select([
                    'id', 'logo_id', 'name_ar', 'name_en', 'symbol'
                ])->with('quote');
            },
        ])->get();

        return response()->json($assets);
    }
}
