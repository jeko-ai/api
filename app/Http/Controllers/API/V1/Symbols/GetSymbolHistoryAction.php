<?php

namespace App\Http\Controllers\API\V1\Symbols;

use App\Models\Symbol;
use Http;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;
use Str;

/**
 * @OA\Get(
 *     path="/v1/symbols/{symbol}/history",
 *     summary="Get symbol historical data",
 *     description="Retrieves historical price data for a specific symbol from investing.com",
 *     tags={"symbols"},
 *     @OA\Parameter(
 *         name="symbol",
 *         in="path",
 *         required=true,
 *         description="Symbol ID to retrieve historical data for",
 *         @OA\Schema(type="string")
 *     ),
 *     @OA\Parameter(
 *         name="resolution",
 *         in="query",
 *         required=false,
 *         description="Data resolution (D for daily, W for weekly, etc.)",
 *         @OA\Schema(type="string", default="D")
 *     ),
 *     @OA\Parameter(
 *         name="from",
 *         in="query",
 *         required=false,
 *         description="Start timestamp for historical data",
 *         @OA\Schema(type="integer", format="int64")
 *     ),
 *     @OA\Parameter(
 *         name="to",
 *         in="query",
 *         required=false,
 *         description="End timestamp for historical data",
 *         @OA\Schema(type="integer", format="int64")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Symbol historical data retrieved successfully",
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
 *         response=404,
 *         description="Symbol not found"
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Internal Server Error"
 *     )
 * )
 */
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
