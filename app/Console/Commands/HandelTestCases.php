<?php

namespace App\Console\Commands;

use App\Models\News;
use App\Models\Subscription;
use App\Models\Symbol;
use App\Models\User;
use Http;
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
        /** @var Subscription $subscription */
        $subscription = $user->activePlanSubscriptions()->first();

        $featureValue = $subscription->getFeatureValue('ai-trading-simulations');
        dump($featureValue);

        $featureValue = $subscription->getFeatureValue('ai-stock-predictions');
        dump($featureValue);

        $usage = $subscription->usage()->byFeatureSlug('ai-trading-simulations', $subscription->plan_id)->first();
        dump($usage);
        $usage = $subscription->usage()->byFeatureSlug('ai-stock-predictions', $subscription->plan_id)->first();
        dump($usage);


        dump($subscription->features);

        dd($subscription->canUseFeature('ai-trading-simulations'), $subscription->canUseFeature('ai-stock-predictions'));
    }

    private function postNewsToFlow()
    {
        $news = News::inRandomOrder()->where('is_rewritten', true)->with([
            'symbol',
            'market',
        ])->first();
        $res = Http::post('http://localhost:5678/webhook-test/864977a8-7d04-4953-a816-117182c68328', $news->toArray());
        if ($res->ok()) {
            $this->info('News posted successfully');
        } else {
            $this->error('Failed to post news');
        }
    }

    private function assignSymbolsToUser()
    {
        $user = User::where('email', 'yasoesr@gmail.com')->first();

        $symbols = Symbol::all();
        $this->output->progressStart($symbols->count());

        foreach ($symbols as $symbol) {
            $user->symbolAlerts()->updateOrCreate([
                'user_id' => $user->id,
                'symbol_id' => $symbol->id,
            ], [
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
            $this->output->progressAdvance();
        }
        $this->output->progressFinish();
    }
}
