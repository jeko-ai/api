<?php

namespace App\Http\Controllers\API\V1\Portfolio;

use App\Models\Portfolios;
use App\Models\PortfolioTransactions;

class GetUserPortfolioTransactionsAction
{
    public function __invoke()
    {
        $latestPortfolio = Portfolios::where('user_id', request()->attributes->get('user_id'))
            ->where('is_default', true)
            ->orderBy('created_at', 'desc')
            ->first();

        $transactions = PortfolioTransactions::where('portfolio_id', $latestPortfolio->id)->get();

        return response()->json($transactions);
    }
}
