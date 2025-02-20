<?php

namespace App\Http\Controllers\API\V1\Recommendations;

use App\Http\Requests\API\V1\Recommendations\CreateRecommendationsRequest;
use App\Http\Resources\API\V1\RecommendationsResource;
use App\Models\Recommendations;
use Illuminate\Routing\Controller;

/**
 * @OA\Post(
 *     path="/v1/recommendations",
 *     summary="Create a new Recommendations",
 *     tags={"Recommendations"},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(ref="#/components/schemas/CreateRecommendationsRequest")
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Created",
 *         @OA\JsonContent(ref="#/components/schemas/RecommendationsResource")
 *     )
 * )
 */
class CreateRecommendations extends Controller
{
    public function __invoke(CreateRecommendationsRequest $request)
    {
        $record = Recommendations::create($request->validated());
        return new RecommendationsResource($record);
    }
}
