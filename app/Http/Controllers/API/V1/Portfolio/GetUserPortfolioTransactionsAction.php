<?php

namespace App\Http\Controllers\API\V1\Portfolio;

use App\Models\Portfolio;
use App\Models\PortfolioTransactions;

class GetUserPortfolioTransactionsAction
{
    public function __invoke()
    {
        $latestPortfolio = Portfolio::where('user_id', request()->attributes->get('user_id'))
            ->where('is_default', true)
            ->orderBy('created_at', 'desc')
            ->first();

        $transactions = PortfolioTransactions::where('portfolio_id', $latestPortfolio->id)->with([
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
