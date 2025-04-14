<?php

namespace App\Jobs;

use App\Models\Recommendation;
use App\Models\User;
use App\Notifications\SymbolHasRecommendations;
use Http;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Notification;

class ProcessRecommendationsNotificationJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(public Recommendation $recommendation)
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
            'is_new_recommendations_alerts_enabled' => true
        ])->whereHas('symbolAlerts', function ($query) {
            $query->where([
                'symbol_id' => $this->recommendation->symbol_id,
                'new_recommendation' => true
            ]);
        })->get();

        Notification::send($users, new SymbolHasRecommendations($this->recommendation));

//        if ($url = config('services.webhooks.social_publisher')) {
//            Http::post($url, $this->recommendation->load(['symbol', 'market'])->toArray());
//        }
    }
}
