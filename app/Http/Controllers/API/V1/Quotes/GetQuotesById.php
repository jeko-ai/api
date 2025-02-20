<?php

namespace App\Http\Controllers\API\V1\Quotes;

use App\Http\Resources\API\V1\QuotesResource;
use App\Models\Quotes;
use Illuminate\Routing\Controller;

/**
 * @OA\Get(
 *     path="/v1/quotes/{id}",
 *     summary="Get Quotes by ID",
 *     tags={"Quotes"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="string", format="uuid")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Successful",
 *         @OA\JsonContent(ref="#/components/schemas/QuotesResource")
 *     )
 * )
 */
class GetQuotesById extends Controller
{
    public function __invoke($id)
    {
        return new QuotesResource(Quotes::findOrFail($id));
    }
}
