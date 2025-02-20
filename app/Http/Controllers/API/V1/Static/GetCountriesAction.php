<?php

namespace App\Http\Controllers\API\V1\Static;

use App\Models\Countries;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\JsonResponse;

/**
 * @OA\Get(
 *     path="/v1/countries",
 *     summary="Get a list of countries",
 *     description="Fetches all countries from the database and caches the response indefinitely.",
 *     tags={"Countries"},
 *     @OA\Response(
 *         response=200,
 *         description="List of countries retrieved successfully",
 *         @OA\JsonContent(
 *             type="array",
 *             @OA\Items(
 *                 type="object",
 *                 @OA\Property(property="id", type="string", example=1),
 *                 @OA\Property(property="name_en", type="string", example="Egypt"),
 *                 @OA\Property(property="name_ar", type="string", example="مصر"),
 *                 @OA\Property(property="code", type="string", example="EG"),
 *                 @OA\Property(property="currency_en", type="string", example="Egyptian Pound"),
 *                 @OA\Property(property="currency_ar", type="string", example="الجنيه المصري"),
 *                 @OA\Property(property="currency_code", type="string", example="EGP")
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Internal Server Error"
 *     )
 * )
 */
class GetCountriesAction
{
    public function __invoke(): JsonResponse
    {
        $countries = Cache::rememberForever('countries', function () {
            return Countries::all();
        });

        return response()->json($countries);
    }
}
