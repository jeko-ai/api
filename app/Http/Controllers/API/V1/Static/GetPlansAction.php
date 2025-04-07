<?php

namespace App\Http\Controllers\API\V1\Static;

use App\Models\Plan;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;

/**
 * @OA\Get(
 *     path="/v1/static/plans",
 *     summary="Get plans",
 *     tags={"Static"},
 *     @OA\Parameter(
 *         name="locale",
 *         in="query",
 *         required=false,
 *         @OA\Schema(type="string")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Successful operation",
 *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Plan"))
 *     ),
 *     @OA\Response(
 *         response=400,
 *         description="Bad request"
 *     )
 * )
 */
class GetPlansAction
{
    public function __invoke(): JsonResponse
    {
        $locale = request()->header('Accept-Language', request('locale', 'en'));

        $plans = Cache::rememberForever("plans-$locale", function () {
            return Plan::with('features')->orderBy('sort_order')->get();
        });

        return response()->json($plans);
    }
}
