<?php

namespace App\Http\Controllers\API\V1\Favorites;

use App\Http\Requests\API\V1\Favorites\CreateFavoritesRequest;
use App\Http\Resources\API\V1\FavoritesResource;
use App\Models\Favorites;
use Illuminate\Routing\Controller;

/**
 * @OA\Post(
 *     path="/api/v1/favorites",
 *     summary="Create a new Favorites",
 *     tags={"Favorites"},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(ref="#/components/schemas/CreateFavoritesRequest")
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Created",
 *         @OA\JsonContent(ref="#/components/schemas/FavoritesResource")
 *     )
 * )
 */
class CreateFavorites extends Controller
{
    public function __invoke(CreateFavoritesRequest $request)
    {
        $record = Favorites::create($request->validated());
        return new FavoritesResource($record);
    }
}
