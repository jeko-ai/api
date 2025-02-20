<?php

namespace App\Http\Controllers\API\V1\Challenges;

use App\Http\Requests\API\V1\Challenges\UpdateChallengesRequest;
use App\Http\Resources\API\V1\ChallengesResource;
use App\Models\Challenges;
use Illuminate\Routing\Controller;

/**
 * @OA\Put(
 *     path="/api/v1/challenges/{id}",
 *     summary="Update Challenges",
 *     tags={"Challenges"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="string", format="uuid")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(ref="#/components/schemas/UpdateChallengesRequest")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Updated",
 *         @OA\JsonContent(ref="#/components/schemas/ChallengesResource")
 *     )
 * )
 */
class UpdateChallenges extends Controller
{
    public function __invoke(UpdateChallengesRequest $request, $id)
    {
        $record = Challenges::findOrFail($id);
        $record->update($request->validated());
        return new ChallengesResource($record);
    }
}
