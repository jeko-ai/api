<?php

namespace App\Jobs;

use App\Models\News;
use App\Models\User;
use App\Notifications\SymbolHasNews;
use Http;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Notification;

class ProcessNewsNotificationJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(public News $news)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $users = User::where([
            'is_notification_enabled' => true,
            'is_market_sentiment_alerts_enabled' => true
        ])->whereHas('symbolAlerts', function ($query) {
            $query->where([
                'symbol_id' => $this->news->symbol_id,
                'latest_news' => true
            ]);
        })->get();

        Notification::send($users, new SymbolHasNews($this->news));

        if ($url = config('services.webhooks.social_publisher')) {
            Http::post($url, $this->news->load(['symbol', 'market'])->toArray());
        }
    }
}
