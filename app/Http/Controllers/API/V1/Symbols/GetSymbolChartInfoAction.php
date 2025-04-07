<?php

namespace App\Http\Controllers\API\V1\Symbols;

use App\Models\Symbol;
use Http;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;
use Str;

/**
 * @OA\Get(
 *     path="/v1/symbols/{symbol}/chart-info",
 *     summary="Get symbol chart information",
 *     description="Retrieves chart data for a specific symbol from investing.com",
 *     tags={"Symbols"},
 *     @OA\Parameter(
 *         name="symbol",
 *         in="path",
 *         required=true,
 *         description="Symbol ID to retrieve chart information for",
 *         @OA\Schema(type="string")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Symbol chart information retrieved successfully",
 *         @OA\JsonContent(
 *             type="object",
 *             description="Chart data from investing.com"
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
class GetSymbolChartInfoAction
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

        $url = "https://tvc4.investing.com/" . Str::uuid()->getHex()->toString() . "/" . time() . "/1/1/8/symbols?symbol={$symbolObject->inv_id}";

        $res = Http::baseUrl(config('app.browser_endpoint'))
            ->withBasicAuth(config('app.browser_user_name'), config('app.browser_password'))
            ->post('/fetch', [
                'url' => $url
            ])->json();
        return response()->json($res);
    }
}
