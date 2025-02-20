<?php

namespace App\Http\Controllers\API\V1\UserLevels;

use App\Http\Requests\API\V1\UserLevels\CreateUserLevelsRequest;
use App\Http\Resources\API\V1\UserLevelsResource;
use App\Models\UserLevels;
use Illuminate\Routing\Controller;

/**
 * @OA\Post(
 *     path="/api/v1/userlevels",
 *     summary="Create a new UserLevels",
 *     tags={"UserLevels"},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(ref="#/components/schemas/CreateUserLevelsRequest")
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Created",
 *         @OA\JsonContent(ref="#/components/schemas/UserLevelsResource")
 *     )
 * )
 */
class CreateUserLevels extends Controller
{
    public function __invoke(CreateUserLevelsRequest $request)
    {
        $record = UserLevels::create($request->validated());
        return new UserLevelsResource($record);
    }
}
