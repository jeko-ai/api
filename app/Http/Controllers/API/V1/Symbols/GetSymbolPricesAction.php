<?php

namespace App\Http\Controllers\API\V1\Symbols;

use App\Models\Symbol;
use Http;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;
use Str;

class GetSymbolPricesAction
{
    public function __invoke(string $symbol, int $from, int $to): JsonResponse
    {
        $symbols = Cache::rememberForever('symbols', function () {
            return Symbol::where('type', 'stock')->get();
        });
        $symbol = collect($symbols)->keyBy('id')->get($symbol);

        $prices = Cache::rememberForever("symbol-$symbol->id-prices-$from-$to", function () use ($symbol, $from, $to) {
            $time = time();
            $id = Str::uuid()->getHex()->toString();

            $url = "https://tvc4.investing.com/$id/$time/1/1/8/history?symbol={$symbol->inv_id}&resolution=D&from=$from&to=$to";

            return Http::baseUrl(config('app.browser_endpoint'))
                ->withBasicAuth(config('app.browser_user_name'), config('app.browser_password'))
                ->post('/fetch', [
                    'url' => $url
                ])->json();
        });


        return response()->json($prices);
    }
}
