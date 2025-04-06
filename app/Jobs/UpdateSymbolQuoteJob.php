<?php

namespace App\Jobs;

use App\Models\Quote;
use App\Models\Symbol;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class UpdateSymbolQuoteJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(public Symbol $symbol, public array $data)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Quote::updateOrCreate($this->data);
    }
}
