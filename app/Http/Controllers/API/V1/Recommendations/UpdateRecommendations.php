<?php

namespace App\Http\Controllers\API\V1\Recommendations;

use App\Http\Requests\API\V1\Recommendations\UpdateRecommendationsRequest;
use App\Http\Resources\API\V1\RecommendationsResource;
use App\Models\Recommendations;
use Illuminate\Routing\Controller;

/**
 * @OA\Put(
 *     path="/api/v1/recommendations/{id}",
 *     summary="Update Recommendations",
 *     tags={"Recommendations"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="string", format="uuid")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(ref="#/components/schemas/UpdateRecommendationsRequest")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Updated",
 *         @OA\JsonContent(ref="#/components/schemas/RecommendationsResource")
 *     )
 * )
 */
class UpdateRecommendations extends Controller
{
    public function __invoke(UpdateRecommendationsRequest $request, $id)
    {
        $record = Recommendations::findOrFail($id);
        $record->update($request->validated());
        return new RecommendationsResource($record);
    }
}
