<?php

namespace App\Http\Controllers\API\V1\Symbols;

use App\Models\Symbols;
use Http;
use Illuminate\Support\Facades\Cache;

class GetSymbolTechnicalAction
{
    public function __invoke(string $symbol, string $timeframe)
    {
        $symbols = Cache::rememberForever('symbols', function () {
            return Symbols::where('type', 'stock')->get();
        });
        $symbol = collect($symbols)->keyBy('id')->get($symbol);

        $timeframes = [
            '5m' => 300,
            '15m' => 900,
            '30m' => 1800,
            '1h' => 3600,
            '5h' => 18000,
            '1d' => 86400,
            '1w' => 604800,
            '1mo' => 2592000,
        ];
        return Cache::remember("symbol-$symbol->id-technical-$timeframe", $timeframes[$timeframe], function () use ($symbol, $timeframe, $timeframes) {
            $url = "https://api.investing.com/api/financialdata/technical/analysis/{$symbol->inv_id}/{$timeframe}";

            return Http::baseUrl(config('app.browser_endpoint'))
                ->withBasicAuth(config('app.browser_user_name'), config('app.browser_password'))
                ->post('/fetch', [
                    'url' => $url
                ])->json();

        });
    }
}
