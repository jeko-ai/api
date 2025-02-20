<?php

namespace App\Http\Controllers\API\V1\UserBadges;

use App\Http\Resources\API\V1\UserBadgesResource;
use App\Models\UserBadges;
use Illuminate\Routing\Controller;

/**
 * @OA\Get(
 *     path="/api/v1/userbadges/{id}",
 *     summary="Get UserBadges by ID",
 *     tags={"UserBadges"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="string", format="uuid")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Successful",
 *         @OA\JsonContent(ref="#/components/schemas/UserBadgesResource")
 *     )
 * )
 */
class GetUserBadgesById extends Controller
{
    public function __invoke($id)
    {
        return new UserBadgesResource(UserBadges::findOrFail($id));
    }
}
