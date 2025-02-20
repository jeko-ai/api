<?php

namespace App\Http\Requests\API\V1\Quotes;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *     schema="CreateQuotesRequest",
 *     @OA\Property(property="id", type="string", format="uuid")
 * )
 */
class CreateQuotesRequest extends FormRequest
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
