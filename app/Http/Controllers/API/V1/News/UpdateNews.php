<?php

namespace App\Http\Controllers\API\V1\News;

use App\Http\Requests\API\V1\News\UpdateNewsRequest;
use App\Http\Resources\API\V1\NewsResource;
use App\Models\News;
use Illuminate\Routing\Controller;

/**
 * @OA\Put(
 *     path="/v1/news/{id}",
 *     summary="Update News",
 *     tags={"News"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="string", format="uuid")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(ref="#/components/schemas/UpdateNewsRequest")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Updated",
 *         @OA\JsonContent(ref="#/components/schemas/NewsResource")
 *     )
 * )
 */
class UpdateNews extends Controller
{
    public function __invoke(UpdateNewsRequest $request, $id)
    {
        $record = News::findOrFail($id);
        $record->update($request->validated());
        return new NewsResource($record);
    }
}
