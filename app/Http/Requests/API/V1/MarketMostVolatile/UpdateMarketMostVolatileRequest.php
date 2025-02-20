<?php

namespace App\Http\Requests\API\V1\MarketMostVolatile;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *     schema="UpdateMarketMostVolatileRequest",
 *     @OA\Property(property="id", type="string", format="uuid")
 * )
 */
class UpdateMarketMostVolatileRequest extends FormRequest
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
