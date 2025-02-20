<?php

namespace App\Http\Controllers\API\V1\Challenges;

use App\Http\Requests\API\V1\Challenges\CreateChallengesRequest;
use App\Http\Resources\API\V1\ChallengesResource;
use App\Models\Challenges;
use Illuminate\Routing\Controller;

/**
 * @OA\Post(
 *     path="/v1/challenges",
 *     summary="Create a new Challenges",
 *     tags={"Challenges"},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(ref="#/components/schemas/CreateChallengesRequest")
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Created",
 *         @OA\JsonContent(ref="#/components/schemas/ChallengesResource")
 *     )
 * )
 */
class CreateChallenges extends Controller
{
    public function __invoke(CreateChallengesRequest $request)
    {
        $record = Challenges::create($request->validated());
        return new ChallengesResource($record);
    }
}
