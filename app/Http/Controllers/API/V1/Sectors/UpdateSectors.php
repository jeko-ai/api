<?php

namespace App\Http\Controllers\API\V1\Sectors;

use App\Http\Requests\API\V1\Sectors\UpdateSectorsRequest;
use App\Http\Resources\API\V1\SectorsResource;
use App\Models\Sectors;
use Illuminate\Routing\Controller;

/**
 * @OA\Put(
 *     path="/api/v1/sectors/{id}",
 *     summary="Update Sectors",
 *     tags={"Sectors"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="string", format="uuid")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(ref="#/components/schemas/UpdateSectorsRequest")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Updated",
 *         @OA\JsonContent(ref="#/components/schemas/SectorsResource")
 *     )
 * )
 */
class UpdateSectors extends Controller
{
    public function __invoke(UpdateSectorsRequest $request, $id)
    {
        $record = Sectors::findOrFail($id);
        $record->update($request->validated());
        return new SectorsResource($record);
    }
}
