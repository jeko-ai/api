<?php

namespace App\Http\Requests\API\V1\SubscriptionFeatureUsage;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *     schema="CreateSubscriptionFeatureUsageRequest",
 *     @OA\Property(property="id", type="string", format="uuid")
 * )
 */
class CreateSubscriptionFeatureUsageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return parent::rules();
    }
}
