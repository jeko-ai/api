<?php

namespace App\Http\Requests\API\V1\Plans;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *     schema="CreatePlansRequest",
 *     @OA\Property(property="id", type="string", format="uuid")
 * )
 */
class CreatePlansRequest extends FormRequest
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
