<?php

namespace App\Http\Requests\API\V1\Recommendations;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *     schema="CreateRecommendationsRequest",
 *     @OA\Property(property="id", type="string", format="uuid")
 * )
 */
class CreateRecommendationsRequest extends FormRequest
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
