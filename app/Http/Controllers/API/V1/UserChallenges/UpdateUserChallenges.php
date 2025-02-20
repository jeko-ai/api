<?php

namespace App\Http\Controllers\API\V1\UserChallenges;

use App\Http\Requests\API\V1\UserChallenges\UpdateUserChallengesRequest;
use App\Http\Resources\API\V1\UserChallengesResource;
use App\Models\UserChallenges;
use Illuminate\Routing\Controller;

/**
 * @OA\Put(
 *     path="/v1/userchallenges/{id}",
 *     summary="Update UserChallenges",
 *     tags={"UserChallenges"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="string", format="uuid")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(ref="#/components/schemas/UpdateUserChallengesRequest")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Updated",
 *         @OA\JsonContent(ref="#/components/schemas/UserChallengesResource")
 *     )
 * )
 */
class UpdateUserChallenges extends Controller
{
    public function __invoke(UpdateUserChallengesRequest $request, $id)
    {
        $record = UserChallenges::findOrFail($id);
        $record->update($request->validated());
        return new UserChallengesResource($record);
    }
}
