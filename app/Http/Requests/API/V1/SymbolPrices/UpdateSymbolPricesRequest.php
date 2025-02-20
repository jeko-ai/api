<?php

namespace App\Http\Requests\API\V1\SymbolPrices;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *     schema="UpdateSymbolPricesRequest",
 *     @OA\Property(property="id", type="string", format="uuid")
 * )
 */
class UpdateSymbolPricesRequest extends FormRequest
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
