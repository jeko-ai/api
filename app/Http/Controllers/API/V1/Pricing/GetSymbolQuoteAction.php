<?php

namespace App\Http\Controllers\API\V1\Pricing;

use App\Jobs\UpdateSymbolQuoteJob;
use App\Models\Symbol;
use Http;
use Str;

/**
 * @OA\Get(
 *     path="/v1/pricing/symbols/{id}/quote",
 *     summary="Get quote of a specific symbol",
 *     tags={"Pricing"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="string")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Successful operation",
 *         @OA\JsonContent(
 *             @OA\Property(property="symbol_id", type="string"),
 *             @OA\Property(property="symbol", type="string"),
 *             @OA\Property(property="name", type="string"),
 *             @OA\Property(property="exchange", type="string"),
 *             @OA\Property(property="description", type="string"),
 *             @OA\Property(property="last_price", type="number", format="float"),
 *             @OA\Property(property="change", type="number", format="float"),
 *             @OA\Property(property="change_percent", type="number", format="float"),
 *             @OA\Property(property="open_price", type="number", format="float"),
 *             @OA\Property(property="high_price", type="number", format="float"),
 *             @OA\Property(property="low_price", type="number", format="float"),
 *             @OA\Property(property="prev_close_price", type="number", format="float"),
 *             @OA\Property(property="volume", type="number", format="float"),
 *             @OA\Property(property="ask_price", type="number", format="float"),
 *             @OA\Property(property="bid_price", type="number", format="float"),
 *             @OA\Property(property="spread", type="number", format="float")
 *         )
 *     )
 * )
 */
class GetSymbolQuoteAction
{
    public function __invoke(string $id)
    {
        $symbol = Symbol::find($id, ['id', 'full_name']);

        $time = time();
        $uuid = Str::uuid()->getHex()->toString();
        $url = "https://tvc4.investing.com/$uuid/$time/1/1/8/quotes?symbols={$symbol->full_name}";

        $res = Http::baseUrl(config('app.browser_endpoint'))
            ->withBasicAuth(config('app.browser_user_name'), config('app.browser_password'))
            ->post('/fetch', [
                'url' => $url
            ])->json();

        $jsonData = $res['d'][0]['v'];

        $data = [
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
        ];

        UpdateSymbolQuoteJob::dispatch($symbol, $data);

        return $data;
    }

    private function cleanNumericValue($value)
    {
        if (!$value) return null;
        return floatval(str_replace(',', '', (string)$value));
    }
}

