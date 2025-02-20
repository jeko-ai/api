<?php

namespace App\Http\Controllers\API\V1\Quotes;

use App\Http\Requests\API\V1\Quotes\CreateQuotesRequest;
use App\Http\Resources\API\V1\QuotesResource;
use App\Models\Quotes;
use Illuminate\Routing\Controller;

/**
 * @OA\Post(
 *     path="/v1/quotes",
 *     summary="Create a new Quotes",
 *     tags={"Quotes"},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(ref="#/components/schemas/CreateQuotesRequest")
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Created",
 *         @OA\JsonContent(ref="#/components/schemas/QuotesResource")
 *     )
 * )
 */
class CreateQuotes extends Controller
{
    public function __invoke(CreateQuotesRequest $request)
    {
        $record = Quotes::create($request->validated());
        return new QuotesResource($record);
    }
}
