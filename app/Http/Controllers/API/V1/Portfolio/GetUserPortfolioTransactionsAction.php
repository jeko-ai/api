<?php

namespace App\Http\Controllers\API\V1\Portfolio;

use App\Models\Portfolio;
use App\Models\PortfolioTransaction;

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
