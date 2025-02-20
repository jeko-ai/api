<?php

namespace App\Http\Requests\API\V1\Portfolios;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *     schema="CreatePortfoliosRequest",
 *     @OA\Property(property="id", type="string", format="uuid")
 * )
 */
class CreatePortfoliosRequest extends FormRequest
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
