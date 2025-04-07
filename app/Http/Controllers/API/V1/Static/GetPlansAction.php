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
 *         @OA\JsonContent(type="array", @OA\Items(type="object",
             @OA\Property(property="id", type="string", format="uuid", description="Plan unique identifier"),
             @OA\Property(property="name", type="object", description="Plan name in different languages"),
             @OA\Property(property="slug", type="string", description="Plan unique slug"),
             @OA\Property(property="description", type="object", nullable=true, description="Plan description in different languages"),
             @OA\Property(property="is_active", type="boolean", description="Whether the plan is active"),
             @OA\Property(property="price", type="number", format="float", description="Plan price"),
             @OA\Property(property="signup_fee", type="number", format="float", description="Plan signup fee"),
             @OA\Property(property="currency", type="string", description="Plan currency"),
             @OA\Property(property="trial_period", type="integer", description="Trial period duration"),
             @OA\Property(property="trial_interval", type="string", description="Trial period interval"),
             @OA\Property(property="invoice_period", type="integer", description="Invoice period duration"),
             @OA\Property(property="invoice_interval", type="string", description="Invoice period interval"),
             @OA\Property(property="grace_period", type="integer", description="Grace period duration"),
             @OA\Property(property="grace_interval", type="string", description="Grace period interval"),
             @OA\Property(property="sort_order", type="integer", description="Plan sort order"),
             @OA\Property(property="created_at", type="string", format="date-time", description="Creation timestamp"),
             @OA\Property(property="updated_at", type="string", format="date-time", description="Last update timestamp"),
             @OA\Property(property="features", type="array", description="Plan features", @OA\Items(type="object",
                 @OA\Property(property="id", type="string", format="uuid", description="Feature unique identifier"),
                 @OA\Property(property="plan_id", type="string", format="uuid", description="Plan unique identifier"),
                 @OA\Property(property="name", type="object", description="Feature name in different languages"),
                 @OA\Property(property="slug", type="string", description="Feature unique slug"),
                 @OA\Property(property="description", type="object", nullable=true, description="Feature description in different languages"),
                 @OA\Property(property="value", type="string", description="Feature value"),
                 @OA\Property(property="resettable_period", type="integer", description="Resettable period duration"),
                 @OA\Property(property="resettable_interval", type="string", description="Resettable period interval"),
                 @OA\Property(property="sort_order", type="integer", description="Feature sort order"),
                 @OA\Property(property="created_at", type="string", format="date-time", description="Creation timestamp"),
                 @OA\Property(property="updated_at", type="string", format="date-time", description="Last update timestamp")
             ))
         ))
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
