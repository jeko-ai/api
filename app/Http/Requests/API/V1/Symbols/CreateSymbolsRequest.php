<?php

namespace App\Http\Requests\API\V1\Symbols;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *     schema="CreateSymbolsRequest",
 *     @OA\Property(property="id", type="string", format="uuid")
 * )
 */
class CreateSymbolsRequest extends FormRequest
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
