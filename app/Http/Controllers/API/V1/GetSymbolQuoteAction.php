<?php

namespace App\Http\Controllers\API\V1;

use App\Models\Quotes;
use App\Models\Symbols;
use Http;
use Illuminate\Support\Facades\Cache;
use Str;

class GetSymbolQuoteAction
{
    public function __invoke(string $id)
    {
        if (Cache::has("quotes-$id")) {
            return Cache::get("quotes-$id");
        }

        $symbols = Cache::rememberForever('symbols', function () {
            return Symbols::where('type', 'stock')->get();
        });
        $symbol = collect($symbols)->keyBy('id')->get($id);

        $quote = Quotes::where('symbol_id', $id)->first();

        if ($quote) {
            if (now()->diffInMinutes($quote->created_at) < 15) {
                return $quote;
            }
        }

        if (!$symbol) {
            $indices = Cache::rememberForever('indices', function () {
                return Symbols::where('type', 'index')->get();
            });
            $symbol = collect($indices)->keyBy('id')->get($id);
        }
        $time = time();
        $uuid = Str::uuid()->getHex()->toString();
        $url = "https://tvc4.investing.com/$uuid/$time/1/1/8/quotes?symbols={$symbol->full_name}";

        $res = Http::baseUrl(config('app.browser_endpoint'))
            ->withBasicAuth(config('app.browser_user_name'), config('app.browser_password'))
            ->post('/fetch', [
                'url' => $url
            ])->json();

        $jsonData = $res['d'][0]['v'];

        $quote = Quotes::firstOrCreate([
            'symbol_id' => $id,
        ],
            [
                'symbol_id' => $id,
                'symbol' => $jsonData['short_name'] ?? 'Unknown',
                'name' => $jsonData['short_name'] ?? 'Unknown',
                'exchange' => trim($jsonData['exchange']) ?? '',
                'description' => $jsonData['description'] ?? '',
                'last_price' => $this->cleanNumericValue($jsonData['lp']) ?? 0,
                'change' => $this->cleanNumericValue($jsonData['ch']) ?? 0,
                'change_percent' => $this->cleanNumericValue($jsonData['chp']) ?? 0,
                'open_price' => $this->cleanNumericValue($jsonData['open_price']) ?? 0,
                'high_price' => $this->cleanNumericValue($jsonData['high_price']) ?? 0,
                'low_price' => $this->cleanNumericValue($jsonData['low_price']) ?? 0,
                'prev_close_price' => $this->cleanNumericValue($jsonData['prev_close_price']) ?? 0,
                'volume' => $this->cleanNumericValue(str_replace(',', '', $jsonData['volume'])) ?? 0,
                'ask_price' => $this->cleanNumericValue($jsonData['ask']) ?? 0,
                'bid_price' => $this->cleanNumericValue($jsonData['bid']) ?? 0,
                'spread' => $this->cleanNumericValue($jsonData['spread']) ?? 0,
                'created_at' => now(),
            ]);
        return Cache::remember("quotes-$id", 5 * 60, function () use ($quote) {
            return $quote;
        });
    }

    private function cleanNumericValue($value)
    {
        if (!$value) return null;
        return floatval(str_replace(',', '', (string)$value));
    }
}
