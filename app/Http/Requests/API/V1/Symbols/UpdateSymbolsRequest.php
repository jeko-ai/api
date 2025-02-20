<?php

namespace App\Http\Requests\API\V1\Symbols;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *     schema="UpdateSymbolsRequest",
 *     @OA\Property(property="id", type="string", format="uuid")
 * )
 */
class UpdateSymbolsRequest extends FormRequest
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
