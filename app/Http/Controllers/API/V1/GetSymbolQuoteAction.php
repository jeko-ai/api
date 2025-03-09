<?php

namespace App\Http\Controllers\API\V1;

use App\Models\Symbols;
use Http;
use Illuminate\Support\Facades\Cache;
use Str;

class GetSymbolQuoteAction
{
    public function __invoke(string $id)
    {
        $symbols = Cache::rememberForever('symbols', function () {
            return Symbols::where('type', 'stock')->get();
        });
        $symbol = collect($symbols)->keyBy('id')->get($id);

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

        return response()->json($res);
    }
}
