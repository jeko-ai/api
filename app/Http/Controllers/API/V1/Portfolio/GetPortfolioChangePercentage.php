<?php

namespace App\Http\Controllers\API\V1\Portfolio;

use App\Models\Portfolio;
use DB;
use Illuminate\Support\Carbon;

class GetPortfolioChangePercentage
{
    public function __invoke()
    {
        $dateToday = Carbon::today()->toDateString();
        $dateYesterday = Carbon::yesterday()->toDateString();

        $latestPortfolio = Portfolio::where('user_id', request()->user()->id)
            ->where('is_default', true)
            ->orderBy('created_at', 'desc')
            ->first();

        $portfolioId = $latestPortfolio->id;

        // Get today's portfolio value
        $todayValue = DB::table('portfolio_history')
            ->where('portfolio_id', $portfolioId)
            ->whereDate('date', $dateToday)
            ->value('total_value');

        // Get yesterday's portfolio value
        $yesterdayValue = DB::table('portfolio_history')
            ->where('portfolio_id', $portfolioId)
            ->whereDate('date', $dateYesterday)
            ->value('total_value');

        // If no previous value exists, return "N/A"
        if ($yesterdayValue == 0) {
            return response()->json(['change_percentage' => 0]);
        }

        // Calculate percentage change
        $changePercentage = round((($todayValue - $yesterdayValue) / $yesterdayValue) * 100, 2);

        // Format response
        $formattedChange = ($changePercentage > 0 ? '+' : '') . $changePercentage . '% from yesterday';

        return response()->json(['change_percentage' => $formattedChange]);
    }
}

