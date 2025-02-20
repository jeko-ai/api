<?php

namespace App\Http\Requests\API\V1\Markets;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *     schema="UpdateMarketsRequest",
 *     @OA\Property(property="id", type="string", format="uuid")
 * )
 */
class UpdateMarketsRequest extends FormRequest
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
