<?php

namespace App\Http\Controllers\API\V1\Sectors;

use App\Http\Requests\API\V1\Sectors\CreateSectorsRequest;
use App\Http\Resources\API\V1\SectorsResource;
use App\Models\Sectors;
use Illuminate\Routing\Controller;

/**
 * @OA\Post(
 *     path="/api/v1/sectors",
 *     summary="Create a new Sectors",
 *     tags={"Sectors"},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(ref="#/components/schemas/CreateSectorsRequest")
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Created",
 *         @OA\JsonContent(ref="#/components/schemas/SectorsResource")
 *     )
 * )
 */
class CreateSectors extends Controller
{
    public function __invoke(CreateSectorsRequest $request)
    {
        $record = Sectors::create($request->validated());
        return new SectorsResource($record);
    }
}
