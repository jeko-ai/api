<?php

namespace App\Http\Controllers\API\V1\UserChallenges;

use App\Http\Resources\API\V1\UserChallengesResource;
use App\Models\UserChallenges;
use Illuminate\Routing\Controller;

/**
 * @OA\Get(
 *     path="/api/v1/userchallenges/{id}",
 *     summary="Get UserChallenges by ID",
 *     tags={"UserChallenges"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="string", format="uuid")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Successful",
 *         @OA\JsonContent(ref="#/components/schemas/UserChallengesResource")
 *     )
 * )
 */
class GetUserChallengesById extends Controller
{
    public function __invoke($id)
    {
        return new UserChallengesResource(UserChallenges::findOrFail($id));
    }
}
