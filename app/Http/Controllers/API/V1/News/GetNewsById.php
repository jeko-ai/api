<?php

namespace App\Http\Controllers\API\V1\News;

use App\Http\Resources\API\V1\NewsResource;
use App\Models\News;
use Illuminate\Routing\Controller;

/**
 * @OA\Get(
 *     path="/api/v1/news/{id}",
 *     summary="Get News by ID",
 *     tags={"News"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="string", format="uuid")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Successful",
 *         @OA\JsonContent(ref="#/components/schemas/NewsResource")
 *     )
 * )
 */
class GetNewsById extends Controller
{
    public function __invoke($id)
    {
        return new NewsResource(News::findOrFail($id));
    }
}
