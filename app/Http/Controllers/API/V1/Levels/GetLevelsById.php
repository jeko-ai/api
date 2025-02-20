<?php

namespace App\Http\Controllers\API\V1\Levels;

use App\Http\Resources\API\V1\LevelsResource;
use App\Models\Levels;
use Illuminate\Routing\Controller;

/**
 * @OA\Get(
 *     path="/api/v1/levels/{id}",
 *     summary="Get Levels by ID",
 *     tags={"Levels"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="string", format="uuid")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Successful",
 *         @OA\JsonContent(ref="#/components/schemas/LevelsResource")
 *     )
 * )
 */
class GetLevelsById extends Controller
{
    public function __invoke($id)
    {
        return new LevelsResource(Levels::findOrFail($id));
    }
}
