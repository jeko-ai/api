<?php

namespace App\Http\Controllers\API\V1\Symbols;

use App\Models\Symbol;
use Http;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;
use Str;

/**
 * @OA\Get(
 *     path="/v1/symbols/{symbol}/{from}/{to}",
 *     summary="Get symbol prices for a specific time range",
 *     description="Retrieves price data for a specific symbol within the given time range",
 *     tags={"symbols"},
 *     @OA\Parameter(
 *         name="symbol",
 *         in="path",
 *         required=true,
 *         description="Symbol ID to retrieve prices for",
 *         @OA\Schema(type="string")
 *     ),
 *     @OA\Parameter(
 *         name="from",
 *         in="path",
 *         required=true,
 *         description="Start timestamp for price data",
 *         @OA\Schema(type="integer", format="int64")
 *     ),
 *     @OA\Parameter(
 *         name="to",
 *         in="path",
 *         required=true,
 *         description="End timestamp for price data",
 *         @OA\Schema(type="integer", format="int64")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Symbol price data retrieved successfully",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="s", type="string", example="ok", description="Status of the request"),
 *             @OA\Property(property="t", type="array", @OA\Items(type="integer"), description="Array of timestamps"),
 *             @OA\Property(property="c", type="array", @OA\Items(type="number"), description="Array of close prices"),
 *             @OA\Property(property="o", type="array", @OA\Items(type="number"), description="Array of open prices"),
 *             @OA\Property(property="h", type="array", @OA\Items(type="number"), description="Array of high prices"),
 *             @OA\Property(property="l", type="array", @OA\Items(type="number"), description="Array of low prices"),
 *             @OA\Property(property="v", type="array", @OA\Items(type="integer"), description="Array of volumes")
 *         )
 *     ),
 *     @OA\Response(
 *         response=401,
 *         description="Unauthorized - User not authenticated"
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Symbol not found"
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Internal Server Error"
 *     )
 * )
 */
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
