<?php

namespace App\Http\Controllers\API\V1\News;

use App\Models\News;
use OpenApi\Annotations as OA;

/**
 * @OA\Get(
 *     path="/v1/news",
 *     summary="Get paginated news list",
 *     description="Returns a paginated list of news articles",
 *     operationId="getNews",
 *     tags={"News"},
 *     @OA\Parameter(
 *         name="Accept-Language",
 *         in="header",
 *         description="Language for news content",
 *         required=false,
 *         @OA\Schema(type="string", default="en")
 *     ),
 *     @OA\Parameter(
 *         name="language",
 *         in="query",
 *         description="Alternative way to specify language",
 *         required=false,
 *         @OA\Schema(type="string", default="en")
 *     ),
 *     @OA\Parameter(
 *         name="limit",
 *         in="query",
 *         description="Number of items per page (max 12)",
 *         required=false,
 *         @OA\Schema(type="integer", default=12)
 *     ),
 *     @OA\Parameter(
 *         name="market_id",
 *         in="query",
 *         description="Filter news by market ID",
 *         required=false,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Parameter(
 *         name="search",
 *         in="query",
 *         description="Search term for news",
 *         required=false,
 *         @OA\Schema(type="string")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Successful operation",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="data", type="array",
 *                 @OA\Items(
 *                     type="object",
 *                     @OA\Property(property="slug", type="string"),
 *                     @OA\Property(property="title", type="string"),
 *                     @OA\Property(property="small_image_url", type="string"),
 *                     @OA\Property(property="symbol_id", type="integer"),
 *                     @OA\Property(property="market_id", type="integer"),
 *                     @OA\Property(property="description", type="string"),
 *                     @OA\Property(property="sentiment", type="string"),
 *                     @OA\Property(property="date", type="string", format="date-time")
 *                 )
 *             ),
 *             @OA\Property(property="links", type="object"),
 *             @OA\Property(property="meta", type="object")
 *         )
 *     )
 * )
 */
class GetNewsAction
{
    public function __invoke()
    {
        $language = request()->header('Accept-Language', request('language', 'en'));
        $limit = min(request('limit', 12), 12);
        $market_id = request('market_id');
        $search = request('search');

        $query = News::isRewritten()
            ->where('language', $language)->select([
                'slug', 'title', 'small_image_url', 'symbol_id', 'market_id', 'description', 'sentiment', 'date'
            ])
            ->orderByDesc('created_at');

        if ($market_id) {
            $query->where('market_id', $market_id);
        }

        return $query->paginate($limit);
    }
}

