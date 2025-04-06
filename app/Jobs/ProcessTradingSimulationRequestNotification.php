<?php

namespace App\Jobs;

use App\Models\TradingSimulationRequest;
use App\Notifications\TradingSimulationRequestStatusUpdated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class ProcessTradingSimulationRequestNotification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(public TradingSimulationRequest $tradingSimulationRequest, public string $type)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->tradingSimulationRequest->user->notify(new TradingSimulationRequestStatusUpdated($this->tradingSimulationRequest));
    }
}
