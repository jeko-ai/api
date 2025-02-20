<?php

namespace App\Http\Controllers\API\V1\Faqs;

use App\Http\Requests\API\V1\Faqs\CreateFaqsRequest;
use App\Http\Resources\API\V1\FaqsResource;
use App\Models\Faqs;
use Illuminate\Routing\Controller;

/**
 * @OA\Post(
 *     path="/api/v1/faqs",
 *     summary="Create a new Faqs",
 *     tags={"Faqs"},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(ref="#/components/schemas/CreateFaqsRequest")
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Created",
 *         @OA\JsonContent(ref="#/components/schemas/FaqsResource")
 *     )
 * )
 */
class CreateFaqs extends Controller
{
    public function __invoke(CreateFaqsRequest $request)
    {
        $record = Faqs::create($request->validated());
        return new FaqsResource($record);
    }
}
