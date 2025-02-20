<?php

namespace App\Http\Controllers\API\V1\Faqs;

use App\Http\Requests\API\V1\Faqs\UpdateFaqsRequest;
use App\Http\Resources\API\V1\FaqsResource;
use App\Models\Faqs;
use Illuminate\Routing\Controller;

/**
 * @OA\Put(
 *     path="/v1/faqs/{id}",
 *     summary="Update Faqs",
 *     tags={"Faqs"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="string", format="uuid")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(ref="#/components/schemas/UpdateFaqsRequest")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Updated",
 *         @OA\JsonContent(ref="#/components/schemas/FaqsResource")
 *     )
 * )
 */
class UpdateFaqs extends Controller
{
    public function __invoke(UpdateFaqsRequest $request, $id)
    {
        $record = Faqs::findOrFail($id);
        $record->update($request->validated());
        return new FaqsResource($record);
    }
}
