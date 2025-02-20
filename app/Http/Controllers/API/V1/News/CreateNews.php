<?php

namespace App\Http\Controllers\API\V1\News;

use App\Http\Requests\API\V1\News\CreateNewsRequest;
use App\Http\Resources\API\V1\NewsResource;
use App\Models\News;
use Illuminate\Routing\Controller;

/**
 * @OA\Post(
 *     path="/v1/news",
 *     summary="Create a new News",
 *     tags={"News"},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(ref="#/components/schemas/CreateNewsRequest")
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Created",
 *         @OA\JsonContent(ref="#/components/schemas/NewsResource")
 *     )
 * )
 */
class CreateNews extends Controller
{
    public function __invoke(CreateNewsRequest $request)
    {
        $record = News::create($request->validated());
        return new NewsResource($record);
    }
}
