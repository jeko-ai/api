<?php

namespace App\Http\Controllers\API\V1\Symbols;

use App\Models\Symbol;
use Http;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;
use Str;

class GetSymbolHistoryAction
{
    public function __invoke($symbol): JsonResponse
    {
        $symbols = Cache::rememberForever('symbols', function () {
            return Symbol::where('type', 'stock')->get();
        });
        $symbolObject = collect($symbols)->keyBy('id')->get($symbol);

        if (!$symbolObject) {
            $indices = Cache::rememberForever('indices', function () {
                return Symbol::where('type', 'index')->get();
            });
            $symbolObject = collect($indices)->keyBy('id')->get($symbol);
        }

        $resolution = request('resolution', 'D');
        $from = request('from', now()->utc()->startOfDay()->timestamp);
        $to = request('to', now()->utc()->endOfDay()->timestamp);

        $url = "https://tvc4.investing.com/" . Str::uuid()->getHex()->toString() . "/" . time() . "/1/1/8/history?symbol={$symbolObject->inv_id}&resolution=$resolution&from=$from&to=$to";

        $res = Http::baseUrl(config('app.browser_endpoint'))
            ->withBasicAuth(config('app.browser_user_name'), config('app.browser_password'))
            ->post('/fetch', [
                'url' => $url
            ])->json();
        return response()->json($res);
    }
}
