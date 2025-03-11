<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class UpdatePortfolioTotalValue extends Command
{
    protected $signature = 'portfolio:update-value';
    protected $description = 'Update portfolio total value every 5 minutes';

    public function handle()
    {
        DB::statement("
            UPDATE portfolios p
            SET total_value = (
                SELECT COALESCE(SUM(pa.quantity * q.last_price), 0)
                FROM portfolio_assets pa
                JOIN quotes q ON pa.symbol_id = s.symbol_id
                WHERE pa.portfolio_id = p.id
            )
            WHERE EXISTS (
                SELECT 1 FROM portfolio_assets WHERE portfolio_id = p.id
            )
        ");

        $this->info("Portfolio Total Value Updated");
    }
}
