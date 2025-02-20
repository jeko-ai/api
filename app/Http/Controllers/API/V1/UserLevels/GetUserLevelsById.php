<?php

namespace App\Http\Controllers\API\V1\UserLevels;

use App\Http\Resources\API\V1\UserLevelsResource;
use App\Models\UserLevels;
use Illuminate\Routing\Controller;

/**
 * @OA\Get(
 *     path="/v1/userlevels/{id}",
 *     summary="Get UserLevels by ID",
 *     tags={"UserLevels"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="string", format="uuid")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Successful",
 *         @OA\JsonContent(ref="#/components/schemas/UserLevelsResource")
 *     )
 * )
 */
class GetUserLevelsById extends Controller
{
    public function __invoke($id)
    {
        return new UserLevelsResource(UserLevels::findOrFail($id));
    }
}
