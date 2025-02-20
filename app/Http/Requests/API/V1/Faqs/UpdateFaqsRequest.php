<?php

namespace App\Http\Requests\API\V1\Faqs;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *     schema="UpdateFaqsRequest",
 *     @OA\Property(property="id", type="string", format="uuid")
 * )
 */
class UpdateFaqsRequest extends FormRequest
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
