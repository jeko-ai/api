<?php

namespace App\Http\Requests\API\V1\MarketMoversLosers;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *     schema="UpdateMarketMoversLosersRequest",
 *     @OA\Property(property="id", type="string", format="uuid")
 * )
 */
class UpdateMarketMoversLosersRequest extends FormRequest
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
