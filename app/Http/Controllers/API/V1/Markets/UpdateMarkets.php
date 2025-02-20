<?php

namespace App\Http\Controllers\API\V1\Markets;

use App\Http\Requests\API\V1\Markets\UpdateMarketsRequest;
use App\Http\Resources\API\V1\MarketsResource;
use App\Models\Markets;
use Illuminate\Routing\Controller;

/**
 * @OA\Put(
 *     path="/v1/markets/{id}",
 *     summary="Update Markets",
 *     tags={"Markets"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="string", format="uuid")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(ref="#/components/schemas/UpdateMarketsRequest")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Updated",
 *         @OA\JsonContent(ref="#/components/schemas/MarketsResource")
 *     )
 * )
 */
class UpdateMarkets extends Controller
{
    public function __invoke(UpdateMarketsRequest $request, $id)
    {
        $record = Markets::findOrFail($id);
        $record->update($request->validated());
        return new MarketsResource($record);
    }
}
