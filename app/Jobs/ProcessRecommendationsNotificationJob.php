<?php

namespace App\Jobs;

use App\Models\News;
use App\Models\Recommendation;
use App\Models\User;
use App\Notifications\SymbolHasNews;
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

    }
}
