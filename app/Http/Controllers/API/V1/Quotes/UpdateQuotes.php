<?php

namespace App\Http\Controllers\API\V1\Quotes;

use App\Http\Requests\API\V1\Quotes\UpdateQuotesRequest;
use App\Http\Resources\API\V1\QuotesResource;
use App\Models\Quotes;
use Illuminate\Routing\Controller;

/**
 * @OA\Put(
 *     path="/api/v1/quotes/{id}",
 *     summary="Update Quotes",
 *     tags={"Quotes"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="string", format="uuid")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(ref="#/components/schemas/UpdateQuotesRequest")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Updated",
 *         @OA\JsonContent(ref="#/components/schemas/QuotesResource")
 *     )
 * )
 */
class UpdateQuotes extends Controller
{
    public function __invoke(UpdateQuotesRequest $request, $id)
    {
        $record = Quotes::findOrFail($id);
        $record->update($request->validated());
        return new QuotesResource($record);
    }
}
