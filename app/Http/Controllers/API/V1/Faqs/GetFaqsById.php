<?php

namespace App\Http\Controllers\API\V1\Faqs;

use App\Http\Resources\API\V1\FaqsResource;
use App\Models\Faqs;
use Illuminate\Routing\Controller;

/**
 * @OA\Get(
 *     path="/v1/faqs/{id}",
 *     summary="Get Faqs by ID",
 *     tags={"Faqs"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="string", format="uuid")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Successful",
 *         @OA\JsonContent(ref="#/components/schemas/FaqsResource")
 *     )
 * )
 */
class GetFaqsById extends Controller
{
    public function __invoke($id)
    {
        return new FaqsResource(Faqs::findOrFail($id));
    }
}
