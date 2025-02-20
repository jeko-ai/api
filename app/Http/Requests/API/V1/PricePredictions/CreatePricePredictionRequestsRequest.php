<?php

namespace App\Http\Requests\API\V1\PricePredictions;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *     schema="CreatePricePredictionRequestsRequest",
 *     @OA\Property(property="id", type="string", format="uuid")
 * )
 */
class CreatePricePredictionRequestsRequest extends FormRequest
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
