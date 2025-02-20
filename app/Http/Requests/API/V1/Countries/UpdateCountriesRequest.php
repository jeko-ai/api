<?php

namespace App\Http\Requests\API\V1\Countries;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *     schema="UpdateCountriesRequest",
 *     @OA\Property(property="id", type="string", format="uuid")
 * )
 */
class UpdateCountriesRequest extends FormRequest
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
