<?php

namespace App\Console\Commands;

use App\Models\Symbol;
use App\Models\User;
use Illuminate\Console\Command;

class HandelTestCases extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:handel-test-cases';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $user = User::where('email', 'yasoesr@gmail.com')->first();

        $symbols = Symbol::all();

        foreach ($symbols as $symbol) {
            $user->symbolAlerts()->create([
                'user_id' => $user->id,
                'symbol_id' => $symbol->id,
                'inv_id' => $symbol->inv_id,
                'tv_id' => $symbol->tv_id,
                'enable_price_alert' => true,
                'price_alert' => true,
                'new_recommendation' => true,
                'latest_news' => true,
                'new_predictions' => true,
                'unusual_volume_alert' => true,
                'volatility_alert' => true,
                'earnings_report_alert' => true,
                'analyst_rating_alert' => true,
                'corporate_events_alert' => true,
                'market_movement_alert' => true,
                'ai_smart_alert' => true,
            ]);
        }
    }
}
