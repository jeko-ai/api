<?php

namespace App\Jobs;

use App\Models\PricePredictionRequest;
use App\Models\TradingSimulationRequest;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Redis;

class NotifyBrainAboutNewRequestJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(public string $type)
    {
        //
    }

    /**
     * Execute the job.
     * @throws ConnectionException
     */
    public function handle(): void
    {
        $type = match ($this->type) {
            PricePredictionRequest::class => 'new_prediction',
            TradingSimulationRequest::class => 'new_simulation',
            default => null,
        };

        if ($type) {
            Redis::publish('new_requests', $type);
        }
    }
}
