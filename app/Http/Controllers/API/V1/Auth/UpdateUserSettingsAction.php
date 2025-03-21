<?php

namespace App\Http\Controllers\API\V1\Auth;

use App\Http\Requests\UpdateUserSettingsRequest;

/**
 * @OA\Post(
 *     path="/v1/auth/settings",
 *     summary="Update authenticated user settings",
 *     description="Updates user profile settings including name, phone, language, risk level, country, and notification preferences",
 *     tags={"Auth"},
 *     security={{
 *         "passport": {}
 *     }},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             @OA\Property(property="name", type="string", example="John Doe", description="User's full name"),
 *             @OA\Property(property="phone", type="string", example="+201234567890", description="User's phone number in international format"),
 *             @OA\Property(property="language", type="string", example="en", description="User's preferred language code"),
 *             @OA\Property(property="risk_level", type="string", enum={"low", "medium", "high"}, example="medium", description="User's investment risk tolerance level"),
 *             @OA\Property(property="country_id", type="string", format="uuid", example="550e8400-e29b-41d4-a716-446655440000", description="UUID of user's country"),
 *             @OA\Property(property="is_notification_enabled", type="boolean", example=true, description="Whether notifications are enabled for the user"),
 *             @OA\Property(property="is_price_alerts_enabled", type="boolean", example=true, description="Whether price alerts are enabled for the user"),
 *             @OA\Property(property="is_new_recommendations_alerts_enabled", type="boolean", example=true, description="Whether new recommendation alerts are enabled for the user"),
 *             @OA\Property(property="is_portfolio_update_alerts_enabled", type="boolean", example=true, description="Whether portfolio update alerts are enabled for the user"),
 *             @OA\Property(property="is_market_sentiment_alerts_enabled", type="boolean", example=true, description="Whether market sentiment alerts are enabled for the user")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="User settings updated successfully",
 *         @OA\JsonContent(ref="#/components/schemas/User")
 *     ),
 *     @OA\Response(
 *         response=401,
 *         description="Unauthenticated",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="Unauthenticated")
 *         )
 *     ),
 *     @OA\Response(
 *         response=422,
 *         description="Validation error",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="The given data was invalid."),
 *             @OA\Property(
 *                 property="errors",
 *                 type="object",
 *                 @OA\AdditionalProperties(
 *                     type="array",
 *                     @OA\Items(type="string")
 *                 )
 *             )
 *         )
 *     )
 * )
 */
class UpdateUserSettingsAction
{
    public function __invoke(UpdateUserSettingsRequest $request)
    {
        $user = $request->user();
        $user->update($request->validated());

        if ($request->has('phone')) {
            $user->phone_verified_at = now();
            $user->save();
        }
        if ($request->has('country_id')) {
            $user->portfolio()->update([
                'currency' => $user->country?->currency_code
            ]);
        }

        return response()->json($user->refresh());
    }
}
