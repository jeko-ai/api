<?php

namespace App\Http\Controllers\API\V1\Favorites;

use App\Http\Requests\API\V1\Favorites\UpdateFavoritesRequest;
use App\Http\Resources\API\V1\FavoritesResource;
use App\Models\Favorites;
use Illuminate\Routing\Controller;

/**
 * @OA\Put(
 *     path="/v1/favorites/{id}",
 *     summary="Update Favorites",
 *     tags={"Favorites"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="string", format="uuid")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(ref="#/components/schemas/UpdateFavoritesRequest")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Updated",
 *         @OA\JsonContent(ref="#/components/schemas/FavoritesResource")
 *     )
 * )
 */
class UpdateFavorites extends Controller
{
    public function __invoke(UpdateFavoritesRequest $request, $id)
    {
        $record = Favorites::findOrFail($id);
        $record->update($request->validated());
        return new FavoritesResource($record);
    }
}
