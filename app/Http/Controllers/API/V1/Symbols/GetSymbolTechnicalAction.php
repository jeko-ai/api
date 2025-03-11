<?php

namespace App\Http\Controllers\API\V1\Symbols;

use App\Models\Symbols;
use Http;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;

/**
 * @OA\Get(
 *     path="/v1/symbols/{symbol}/technical/{timeframe}",
 *     summary="Get symbol technical analysis",
 *     description="Retrieves technical analysis data for a specific symbol with the given timeframe",
 *     tags={"symbols"},
 *     @OA\Parameter(
 *         name="symbol",
 *         in="path",
 *         required=true,
 *         description="Symbol ID to retrieve technical analysis for",
 *         @OA\Schema(type="string")
 *     ),
 *     @OA\Parameter(
 *         name="timeframe",
 *         in="path",
 *         required=true,
 *         description="Timeframe for technical analysis",
 *         @OA\Schema(
 *             type="string",
 *             enum={"5m", "15m", "30m", "1h", "5h", "1d", "1w", "1mo"},
 *             default="1d"
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Symbol technical analysis retrieved successfully",
 *         @OA\JsonContent(
 *             type="object",
 *             description="Technical analysis data from investing.com"
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
class GetSymbolTechnicalAction
{
    public function __invoke(string $symbol, string $timeframe): JsonResponse
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
