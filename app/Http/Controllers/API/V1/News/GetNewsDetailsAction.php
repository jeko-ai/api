<?php

namespace App\Http\Controllers\API\V1\News;

use App\Models\News;
use OpenApi\Annotations as OA;

/**
 * @OA\Get(
 *     path="/v1/news/{slug}",
 *     summary="Get news details",
 *     description="Returns detailed information about a specific news article",
 *     operationId="getNewsDetails",
 *     tags={"News"},
 *     @OA\Parameter(
 *         name="slug",
 *         in="path",
 *         description="Slug of the news article",
 *         required=true,
 *         @OA\Schema(type="string")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Successful operation",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="id", type="integer"),
 *             @OA\Property(property="slug", type="string"),
 *             @OA\Property(property="title", type="string"),
 *             @OA\Property(property="content", type="string"),
 *             @OA\Property(property="small_image_url", type="string"),
 *             @OA\Property(property="large_image_url", type="string"),
 *             @OA\Property(property="symbol_id", type="integer"),
 *             @OA\Property(property="market_id", type="integer"),
 *             @OA\Property(property="description", type="string"),
 *             @OA\Property(property="sentiment", type="string"),
 *             @OA\Property(property="language", type="string"),
 *             @OA\Property(property="date", type="string", format="date-time"),
 *             @OA\Property(property="created_at", type="string", format="date-time"),
 *             @OA\Property(property="updated_at", type="string", format="date-time")
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="News article not found"
 *     )
 * )
 */
class GetNewsDetailsAction
{
    public function __invoke(string $slug)
    {
        $news = News::isRewritten()->where('slug', $slug)->firstOrFail();

        return response()->json($news);
    }
}

