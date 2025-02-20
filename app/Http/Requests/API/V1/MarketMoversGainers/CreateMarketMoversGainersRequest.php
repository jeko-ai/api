<?php

namespace App\Http\Requests\API\V1\MarketMoversGainers;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *     schema="CreateMarketMoversGainersRequest",
 *     @OA\Property(property="id", type="string", format="uuid")
 * )
 */
class CreateMarketMoversGainersRequest extends FormRequest
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
