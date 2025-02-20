<?php

namespace App\Http\Controllers\API\V1\Badges;

use App\Http\Resources\API\V1\BadgesResource;
use App\Models\Badges;
use Illuminate\Routing\Controller;

/**
 * @OA\Get(
 *     path="/api/v1/badges/{id}",
 *     summary="Get Badges by ID",
 *     tags={"Badges"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="string", format="uuid")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Successful",
 *         @OA\JsonContent(ref="#/components/schemas/BadgesResource")
 *     )
 * )
 */
class GetBadgesById extends Controller
{
    public function __invoke($id)
    {
        return new BadgesResource(Badges::findOrFail($id));
    }
}
