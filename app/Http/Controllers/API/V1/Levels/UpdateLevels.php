<?php

namespace App\Http\Controllers\API\V1\Levels;

use App\Http\Requests\API\V1\Levels\UpdateLevelsRequest;
use App\Http\Resources\API\V1\LevelsResource;
use App\Models\Levels;
use Illuminate\Routing\Controller;

/**
 * @OA\Put(
 *     path="/v1/levels/{id}",
 *     summary="Update Levels",
 *     tags={"Levels"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="string", format="uuid")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(ref="#/components/schemas/UpdateLevelsRequest")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Updated",
 *         @OA\JsonContent(ref="#/components/schemas/LevelsResource")
 *     )
 * )
 */
class UpdateLevels extends Controller
{
    public function __invoke(UpdateLevelsRequest $request, $id)
    {
        $record = Levels::findOrFail($id);
        $record->update($request->validated());
        return new LevelsResource($record);
    }
}
