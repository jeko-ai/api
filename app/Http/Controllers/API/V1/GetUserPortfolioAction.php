<?php

namespace App\Http\Controllers\API\V1;

use App\Models\PortfolioHistory;
use App\Models\Portfolios;

class GetUserPortfolioAction
{
    public function __invoke()
    {
        // Get the latest default portfolio
        $latestPortfolio = Portfolios::where('user_id', request()->attributes->get('user_id'))
            ->where('is_default', true)
            ->orderBy('created_at', 'desc')
            ->first();

        if (!$latestPortfolio) {
            return response()->json(['status' => 'no_portfolio'], 404);
        }

        // Get the previous day's total value
        $previousValue = PortfolioHistory::where('portfolio_id', $latestPortfolio->id)
            ->whereDate('date', now()->subDay()->toDateString())
            ->orderBy('date', 'desc')
            ->value('total_value');

        // Calculate the percentage change
        $previousValue = $previousValue ?? $latestPortfolio->total_value; // Default to current value if no history exists
        $changePercentage = $previousValue != 0
            ? round((($latestPortfolio->total_value - $previousValue) / $previousValue) * 100, 2)
            : 0;

        return response()->json([
            'id' => $latestPortfolio->id,
            'name' => $latestPortfolio->name,
            'description' => $latestPortfolio->description,
            'total_value' => $latestPortfolio->total_value,
            'currency' => $latestPortfolio->currency,
            'is_default' => $latestPortfolio->is_default,
            'created_at' => $latestPortfolio->created_at,
            'change_percentage' => $changePercentage,
            'previous_total_value' => $previousValue,
        ]);
    }
}
