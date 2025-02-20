<?php

namespace App\Http\Controllers\API\V1\Favorites;

use App\Http\Resources\API\V1\FavoritesResource;
use App\Models\Favorites;
use Illuminate\Routing\Controller;

/**
 * @OA\Get(
 *     path="/api/v1/favorites/{id}",
 *     summary="Get Favorites by ID",
 *     tags={"Favorites"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="string", format="uuid")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Successful",
 *         @OA\JsonContent(ref="#/components/schemas/FavoritesResource")
 *     )
 * )
 */
class GetFavoritesById extends Controller
{
    public function __invoke($id)
    {
        return new FavoritesResource(Favorites::findOrFail($id));
    }
}
