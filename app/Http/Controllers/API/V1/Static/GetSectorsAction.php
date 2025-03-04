<?php

namespace App\Http\Controllers\API\V1\Static;

use App\Models\Markets;
use App\Models\Sectors;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;

/**
 * @OA\Get(
 *     path="/v1/static/sectors",
 *     summary="Get a list of sectors",
 *     description="Fetches all markets from the database and caches the response indefinitely.",
 *     tags={"static"},
 *     @OA\Response(
 *         response=200,
 *         description="List of sectors retrieved successfully",
 *         @OA\JsonContent(
 *             type="array",
 *             @OA\Items(
 *                 type="object",
 *                 @OA\Property(property="id", type="string", example=1),
 *                 @OA\Property(property="name_en", type="string", example="Egyptian Exchange"),
 *                 @OA\Property(property="name_ar", type="string", example="البورصة المصرية"),
 *                 @OA\Property(property="description_en", type="string", example="Egyptian Exchange"),
 *                 @OA\Property(property="description_ar", type="string", example="البورصة المصرية")
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Internal Server Error"
 *     )
 * )
 */
class GetSectorsAction
{
    public function __invoke(): JsonResponse
    {
        $sectors = Cache::rememberForever('sectors', function () {
            return Sectors::all();
        });

        return response()->json($sectors);
    }
}
