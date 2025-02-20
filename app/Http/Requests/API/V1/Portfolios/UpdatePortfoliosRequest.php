<?php

namespace App\Http\Requests\API\V1\Portfolios;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *     schema="UpdatePortfoliosRequest",
 *     @OA\Property(property="id", type="string", format="uuid")
 * )
 */
class UpdatePortfoliosRequest extends FormRequest
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
