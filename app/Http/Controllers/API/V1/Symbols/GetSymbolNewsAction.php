<?php

namespace App\Http\Controllers\API\V1\Symbols;

use App\Models\News;
use Illuminate\Support\Facades\Cache;

/**
 * @OA\Get(
 *     path="/v1/symbols/{symbol}/news",
 *     summary="Get news for a symbol",
 *     tags={"Symbols"},
 *     @OA\Parameter(
 *         name="symbol",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="string")
 *     ),
 *     @OA\Parameter(
 *         name="sentiment",
 *         in="query",
 *         required=true,
 *         @OA\Schema(type="string")
 *     ),
 *     @OA\Parameter(
 *         name="limit",
 *         in="query",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="News list",
 *         @OA\JsonContent(
 *             type="array",
 *             @OA\Items(ref="#/components/schemas/News")
 *         )
 *     )
 * )
 */
class GetSymbolNewsAction
{
    public function __invoke(string $symbol, string $sentiment)
    {
        $locale = request()->header('Accept-Language', request('locale', 'en'));
        $limit = request('limit');

        $query = News::isRewritten()->select([
            'slug', 'title', 'small_image_url', 'symbol_id', 'market_id', 'description', 'sentiment', 'date'
        ])->where('sentiment', $sentiment)->where('language', $locale)
            ->orderByDesc('created_at')
            ->where('symbol_id', $symbol);

        if ($limit) {
            $query->limit($limit);
        }

        return Cache::remember("news-$sentiment-$symbol-$limit-$locale", 60 * 60, function () use ($query) {
            return $query->get();
        });
    }
}
