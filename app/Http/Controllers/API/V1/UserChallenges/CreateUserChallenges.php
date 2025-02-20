<?php

namespace App\Http\Controllers\API\V1\UserChallenges;

use App\Http\Requests\API\V1\UserChallenges\CreateUserChallengesRequest;
use App\Http\Resources\API\V1\UserChallengesResource;
use App\Models\UserChallenges;
use Illuminate\Routing\Controller;

/**
 * @OA\Post(
 *     path="/api/v1/userchallenges",
 *     summary="Create a new UserChallenges",
 *     tags={"UserChallenges"},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(ref="#/components/schemas/CreateUserChallengesRequest")
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Created",
 *         @OA\JsonContent(ref="#/components/schemas/UserChallengesResource")
 *     )
 * )
 */
class CreateUserChallenges extends Controller
{
    public function __invoke(CreateUserChallengesRequest $request)
    {
        $record = UserChallenges::create($request->validated());
        return new UserChallengesResource($record);
    }
}
