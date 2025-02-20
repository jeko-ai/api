<?php

namespace App\Http\Requests\API\V1\PortfolioHistory;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *     schema="UpdatePortfolioHistoryRequest",
 *     @OA\Property(property="id", type="string", format="uuid")
 * )
 */
class UpdatePortfolioHistoryRequest extends FormRequest
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
