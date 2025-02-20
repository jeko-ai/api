<?php

namespace App\Http\Requests\API\V1\SubscriptionFeatures;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *     schema="CreateSubscriptionFeaturesRequest",
 *     @OA\Property(property="id", type="string", format="uuid")
 * )
 */
class CreateSubscriptionFeaturesRequest extends FormRequest
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
