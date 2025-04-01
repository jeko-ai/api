<?php

namespace App\Jobs;

use App\Models\PricePredictionRequest;
use App\Models\TradingSimulationRequest;
use Http;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Http\Client\ConnectionException;

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
        if (config('services.brain.api_url') && config('services.brain.api_key')) {
            $url = match ($this->type) {
                PricePredictionRequest::class => config('services.brain.api_url') . '/api/new-prediction',
                TradingSimulationRequest::class => config('services.brain.api_url') . '/api/new-simulation',
                default => null,
            };
            if ($url) {
                Http::post($url, []);
            }
        }
    }
}
