<?php

namespace App\Http\Controllers\API\V1\Badges;

use App\Http\Requests\API\V1\Badges\CreateBadgesRequest;
use App\Http\Resources\API\V1\BadgesResource;
use App\Models\Badges;
use Illuminate\Routing\Controller;

/**
 * @OA\Post(
 *     path="/api/v1/badges",
 *     summary="Create a new Badges",
 *     tags={"Badges"},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(ref="#/components/schemas/CreateBadgesRequest")
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Created",
 *         @OA\JsonContent(ref="#/components/schemas/BadgesResource")
 *     )
 * )
 */
class CreateBadges extends Controller
{
    public function __invoke(CreateBadgesRequest $request)
    {
        $record = Badges::create($request->validated());
        return new BadgesResource($record);
    }
}
