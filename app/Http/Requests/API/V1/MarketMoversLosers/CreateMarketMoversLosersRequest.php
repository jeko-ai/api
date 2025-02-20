<?php

namespace App\Http\Requests\API\V1\MarketMoversLosers;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *     schema="CreateMarketMoversLosersRequest",
 *     @OA\Property(property="id", type="string", format="uuid")
 * )
 */
class CreateMarketMoversLosersRequest extends FormRequest
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
