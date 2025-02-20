<?php

namespace App\Http\Requests\API\V1\MarketMoversActive;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *     schema="UpdateMarketMoversActiveRequest",
 *     @OA\Property(property="id", type="string", format="uuid")
 * )
 */
class UpdateMarketMoversActiveRequest extends FormRequest
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
