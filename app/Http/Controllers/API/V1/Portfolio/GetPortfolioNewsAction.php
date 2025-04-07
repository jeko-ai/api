<?php

namespace App\Http\Controllers\API\V1\Portfolio;

use App\Models\News;
use App\Models\PortfolioAsset;
use Illuminate\Support\Facades\Cache;

/**
 * @OA\Get(
 *     path="/v1/portfolio/news/{sentiment}",
 *     operationId="getPortfolioNews",
 *     tags={"Portfolio"},
 *     summary="Get news related to assets in user's portfolio filtered by sentiment",
 *     description="Returns news articles related to assets in the user's portfolio with specified sentiment",
 *     security={{"bearerAuth":{}}},
 *     @OA\Parameter(
 *         name="sentiment",
 *         in="path",
 *         required=true,
 *         description="News sentiment filter (positive, negative, neutral)",
 *         @OA\Schema(type="string")
 *     ),
 *     @OA\Parameter(
 *         name="limit",
 *         in="query",
 *         required=false,
 *         description="Maximum number of news items to return",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Parameter(
 *         name="Accept-Language",
 *         in="header",
 *         required=false,
 *         description="Language preference (en, ar)",
 *         @OA\Schema(type="string", default="en")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Successful operation",
 *         @OA\JsonContent(
 *             type="array",
 *             @OA\Items(
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
 *     ),
 *     @OA\Response(
 *         response=401,
 *         description="Unauthenticated"
 *     )
 * )
 */
class GetPortfolioNewsAction
{
    public function __invoke(string $sentiment)
    {
        $userId = auth()->user()->id;

        $locale = request()->header('Accept-Language', request('locale', 'en'));
        $limit = request('limit');

        $assets = PortfolioAsset::where('user_id', $userId)->get(['symbol_id'])->pluck('symbol_id');

        $query = News::isRewritten()->select([
            'slug', 'title', 'small_image_url', 'symbol_id', 'market_id', 'description', 'sentiment', 'date'
        ])->where('sentiment', $sentiment)
            ->where('language', $locale)
            ->whereIn('symbol_id', $assets)
            ->orderByDesc('created_at');


        if ($limit) {
            $query->limit($limit);
        }

        return Cache::remember("news-$sentiment-$userId-$limit-$locale", 60 * 60, function () use ($query) {
            return $query->get();
        });
    }
}

