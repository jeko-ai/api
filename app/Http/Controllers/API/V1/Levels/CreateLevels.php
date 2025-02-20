<?php

namespace App\Http\Controllers\API\V1\Levels;

use App\Http\Requests\API\V1\Levels\CreateLevelsRequest;
use App\Http\Resources\API\V1\LevelsResource;
use App\Models\Levels;
use Illuminate\Routing\Controller;

/**
 * @OA\Post(
 *     path="/api/v1/levels",
 *     summary="Create a new Levels",
 *     tags={"Levels"},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(ref="#/components/schemas/CreateLevelsRequest")
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Created",
 *         @OA\JsonContent(ref="#/components/schemas/LevelsResource")
 *     )
 * )
 */
class CreateLevels extends Controller
{
    public function __invoke(CreateLevelsRequest $request)
    {
        $record = Levels::create($request->validated());
        return new LevelsResource($record);
    }
}
