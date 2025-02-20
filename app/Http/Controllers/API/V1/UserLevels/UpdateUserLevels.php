<?php

namespace App\Http\Controllers\API\V1\UserLevels;

use App\Http\Requests\API\V1\UserLevels\UpdateUserLevelsRequest;
use App\Http\Resources\API\V1\UserLevelsResource;
use App\Models\UserLevels;
use Illuminate\Routing\Controller;

/**
 * @OA\Put(
 *     path="/v1/userlevels/{id}",
 *     summary="Update UserLevels",
 *     tags={"UserLevels"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="string", format="uuid")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(ref="#/components/schemas/UpdateUserLevelsRequest")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Updated",
 *         @OA\JsonContent(ref="#/components/schemas/UserLevelsResource")
 *     )
 * )
 */
class UpdateUserLevels extends Controller
{
    public function __invoke(UpdateUserLevelsRequest $request, $id)
    {
        $record = UserLevels::findOrFail($id);
        $record->update($request->validated());
        return new UserLevelsResource($record);
    }
}
