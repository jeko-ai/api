<?php

namespace App\Http\Requests\API\V1\MarketMoversGainers;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *     schema="UpdateMarketMoversGainersRequest",
 *     @OA\Property(property="id", type="string", format="uuid")
 * )
 */
class UpdateMarketMoversGainersRequest extends FormRequest
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
