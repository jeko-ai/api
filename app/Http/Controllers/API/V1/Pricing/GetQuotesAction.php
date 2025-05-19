<?php

namespace App\Http\Controllers\API\V1\Pricing;

use App\Models\Quote;
use Illuminate\Support\Facades\Cache;

class GetQuotesAction
{
    public function __invoke()
    {
        if (Cache::has("quotes")) {
            return Cache::get("quotes");
        }
        return Cache::remember("quotes", 5 * 60, function () {
            return Quote::all()->keyBy("symbol_id");
        });
    }
}

