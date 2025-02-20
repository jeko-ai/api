<?php

namespace App\Http\Requests\API\V1\MarketMoversActive;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *     schema="CreateMarketMoversActiveRequest",
 *     @OA\Property(property="id", type="string", format="uuid")
 * )
 */
class CreateMarketMoversActiveRequest extends FormRequest
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
