<?php

namespace App\Http\Controllers\API\V1\Symbols;

use App\Models\Symbols;
use Illuminate\Support\Facades\Cache;

class GetSymbolChartInfoAction
{
    public function __invoke($symbol)
    {
        $symbols = Cache::rememberForever('symbols', function () {
            return Symbols::where('type', 'stock')->get();
        });
        $symbol = collect($symbols)->keyBy('id')->get($symbol);
        $url = "https://tvc4.investing.com/" . \Str::uuid()->getHex()->toString() . "/" . time() . "/1/1/8/symbols?symbol={$symbol->inv_id}";

        $res = \Http::baseUrl(config('app.browser_endpoint'))
            ->withBasicAuth(config('app.browser_user_name'), config('app.browser_password'))
            ->post('/fetch', [
                'url' => $url
            ])->json();

        dd([
            'symbol' => $symbol,
            'url' => $url,
            'response' => $res
        ]);
        return response()->json($res);
    }
}
