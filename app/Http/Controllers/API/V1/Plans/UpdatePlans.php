<?php

namespace App\Http\Controllers\API\V1\Plans;

use App\Http\Requests\API\V1\Plans\UpdatePlansRequest;
use App\Http\Resources\API\V1\PlansResource;
use App\Models\Plans;
use Illuminate\Routing\Controller;

/**
 * @OA\Put(
 *     path="/v1/plans/{id}",
 *     summary="Update Plans",
 *     tags={"Plans"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="string", format="uuid")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(ref="#/components/schemas/UpdatePlansRequest")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Updated",
 *         @OA\JsonContent(ref="#/components/schemas/PlansResource")
 *     )
 * )
 */
class UpdatePlans extends Controller
{
    public function __invoke(UpdatePlansRequest $request, $id)
    {
        $record = Plans::findOrFail($id);
        $record->update($request->validated());
        return new PlansResource($record);
    }
}
