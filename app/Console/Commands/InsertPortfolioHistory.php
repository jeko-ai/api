<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class InsertPortfolioHistory extends Command
{
    protected $signature = 'portfolio:insert-history';
    protected $description = 'Insert daily portfolio history with total value and percentage change';

    public function handle()
    {
        $dateToday = Carbon::today()->toDateString();
        $dateYesterday = Carbon::yesterday()->toDateString();

        // Fetch portfolio history calculations
        $portfolios = DB::table('portfolios as p')
            ->leftJoin('portfolio_assets as pa', 'pa.portfolio_id', '=', 'p.id')
            ->leftJoin('quotes as q', 'pa.symbol_id', '=', 'q.symbol_id')
            ->leftJoin('portfolio_history as ph', function ($join) use ($dateYesterday) {
                $join->on('ph.portfolio_id', '=', 'p.id')
                    ->whereDate('ph.date', $dateYesterday);
            })
            ->select([
                'p.id as portfolio_id',
                'p.user_id',
                DB::raw('CURRENT_DATE as date'),
                DB::raw('COALESCE(SUM(pa.quantity * q.last_price), 0) as total_value'),
                DB::raw('COALESCE(
                ROUND(((SUM(pa.quantity * q.last_price) - COALESCE(ph.total_value, 0)) / NULLIF(ph.total_value, 0)) * 100, 2),
                0
            ) as change_percentage')
            ])
            ->groupBy('p.id', 'p.user_id', 'ph.total_value')
            ->get();

        // Insert each calculated record into portfolio_history
        foreach ($portfolios as $portfolio) {
            DB::table('portfolio_history')->insertOrIgnore([
                'portfolio_id' => $portfolio->portfolio_id,
                'user_id' => $portfolio->user_id,
                'date' => $portfolio->date,
                'total_value' => $portfolio->total_value,
                'change_percentage' => $portfolio->change_percentage,
            ]);
        }

        $this->info('Portfolio history updated successfully.');
    }
}
