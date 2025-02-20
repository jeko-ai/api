<?php

namespace App\Http\Controllers\API\V1\UserBadges;

use App\Http\Requests\API\V1\UserBadges\CreateUserBadgesRequest;
use App\Http\Resources\API\V1\UserBadgesResource;
use App\Models\UserBadges;
use Illuminate\Routing\Controller;

/**
 * @OA\Post(
 *     path="/v1/userbadges",
 *     summary="Create a new UserBadges",
 *     tags={"UserBadges"},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(ref="#/components/schemas/CreateUserBadgesRequest")
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Created",
 *         @OA\JsonContent(ref="#/components/schemas/UserBadgesResource")
 *     )
 * )
 */
class CreateUserBadges extends Controller
{
    public function __invoke(CreateUserBadgesRequest $request)
    {
        $record = UserBadges::create($request->validated());
        return new UserBadgesResource($record);
    }
}
