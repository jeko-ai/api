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

        DB::statement("
            INSERT INTO portfolio_history (portfolio_id, user_id, date, total_value, change_percentage)
            SELECT
                p.id AS portfolio_id,
                p.user_id,
                CURRENT_DATE AS date,
                COALESCE(SUM(pa.quantity * s.current_price), 0) AS total_value,
                COALESCE(
                    ROUND(((SUM(pa.quantity * s.current_price) - ph.total_value) / NULLIF(ph.total_value, 0)) * 100, 2),
                    0
                ) AS change_percentage
            FROM portfolios p
            LEFT JOIN portfolio_assets pa ON pa.portfolio_id = p.id
            LEFT JOIN symbols s ON pa.symbol_id = s.id
            LEFT JOIN portfolio_history ph
            ON ph.portfolio_id = p.id
            AND ph.date = ?
            GROUP BY p.id, p.user_id, ph.total_value
            ON CONFLICT (portfolio_id, date) DO NOTHING;
        ", [$dateYesterday]);

        $this->info('Portfolio history updated successfully.');
    }
}
