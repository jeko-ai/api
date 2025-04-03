<?php

namespace App\Jobs;

use App\Models\PricePredictionRequest;
use App\Notifications\PricePredictionRequestStatusUpdated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class ProcessPricePredictionRequestNotification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(public PricePredictionRequest $predictionRequest, public string $type)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->predictionRequest->user->notify(new PricePredictionRequestStatusUpdated($this->predictionRequest));
    }
}
