<?php

namespace App\Http\Requests\API\V1\SubscriptionFeatures;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *     schema="UpdateSubscriptionFeaturesRequest",
 *     @OA\Property(property="id", type="string", format="uuid")
 * )
 */
class UpdateSubscriptionFeaturesRequest extends FormRequest
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
