<?php

namespace App\Http\Controllers\API\V1\News;

use App\Models\News;
use Illuminate\Support\Facades\Cache;
use OpenApi\Annotations as OA;

/**
 * @OA\Get(
 *     path="/v1/news/{sentiment}",
 *     summary="Get news by sentiment",
 *     description="Returns news articles filtered by sentiment",
 *     operationId="getNewsBySentiment",
 *     tags={"News"},
 *     @OA\Parameter(
 *         name="sentiment",
 *         in="path",
 *         description="Sentiment type to filter by",
 *         required=true,
 *         @OA\Schema(type="string", enum={"positive", "negative", "neutral"})
 *     ),
 *     @OA\Parameter(
 *         name="Accept-Language",
 *         in="header",
 *         description="Language for news content",
 *         required=false,
 *         @OA\Schema(type="string", default="en")
 *     ),
 *     @OA\Parameter(
 *         name="locale",
 *         in="query",
 *         description="Alternative way to specify language",
 *         required=false,
 *         @OA\Schema(type="string", default="en")
 *     ),
 *     @OA\Parameter(
 *         name="limit",
 *         in="query",
 *         description="Maximum number of news items to return",
 *         required=false,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Parameter(
 *         name="market_id",
 *         in="query",
 *         description="Filter news by market ID",
 *         required=false,
 *         @OA\Schema(type="string")
 *     ),
 *     @OA\Parameter(
 *         name="symbol_id",
 *         in="query",
 *         description="Filter news by symbol ID",
 *         required=false,
 *         @OA\Schema(type="string")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Successful operation",
 *         @OA\JsonContent(
 *             type="array",
 *             @OA\Items(
 *                 type="object",
 *                 @OA\Property(property="slug", type="string"),
 *                 @OA\Property(property="title", type="string"),
 *                 @OA\Property(property="small_image_url", type="string"),
 *                 @OA\Property(property="symbol_id", type="integer"),
 *                 @OA\Property(property="market_id", type="integer"),
 *                 @OA\Property(property="description", type="string"),
 *                 @OA\Property(property="sentiment", type="string"),
 *                 @OA\Property(property="date", type="string", format="date-time")
 *             )
 *         )
 *     )
 * )
 */
class GetNewsBySentiment
{
    public function __invoke(string $sentiment)
    {
        $locale = request()->header('Accept-Language', request('locale', 'en'));
        $limit = request('limit');
        $market_id = request('market_id');

        $query = News::isRewritten()->select([
            'slug', 'title', 'small_image_url', 'symbol_id', 'market_id', 'description', 'sentiment', 'date'
        ])->where('sentiment', $sentiment)->where('language', $locale)->orderByDesc('created_at');

        if ($limit) {
            $query->limit($limit);
        }
        $key = "news-$sentiment-$market_id-$limit-$locale";

        if ($market_id) {
            $query->where('market_id', $market_id);
            $key = "news-$sentiment-$market_id-$limit-$locale";
        }

        return Cache::remember($key, 60 * 60, function () use ($query) {
            return $query->get();
        });
    }
}

