<?php

namespace App\Http\Controllers\API\V1\Symbols;

use App\Models\Symbols;
use Http;
use Illuminate\Support\Facades\Cache;
use Str;

class GetSymbolPricesAction
{
    public function __invoke(string $symbol, int $from, int $to)
    {
        $symbols = Cache::rememberForever('symbols', function () {
            return Symbols::where('type', 'stock')->get();
        });
        $symbol = collect($symbols)->keyBy('id')->get($symbol);
        $time = time();
        $id = Str::uuid()->getHex()->toString();

        $url = "https://tvc4.investing.com/$id/$time/1/1/8/history?symbol={$symbol->inv_id}&resolution=D&from=$from&to=$to";

        $res = Http::baseUrl(config('app.browser_endpoint'))
            ->withBasicAuth(config('app.browser_user_name'), config('app.browser_password'))
            ->post('/fetch', [
                'url' => $url
            ])->json();
        return response()->json($res);
    }
}
