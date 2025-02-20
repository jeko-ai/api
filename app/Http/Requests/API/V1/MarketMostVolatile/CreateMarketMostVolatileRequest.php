<?php

namespace App\Http\Requests\API\V1\MarketMostVolatile;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *     schema="CreateMarketMostVolatileRequest",
 *     @OA\Property(property="id", type="string", format="uuid")
 * )
 */
class CreateMarketMostVolatileRequest extends FormRequest
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
