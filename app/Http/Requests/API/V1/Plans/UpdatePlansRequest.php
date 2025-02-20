<?php

namespace App\Http\Requests\API\V1\Plans;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *     schema="UpdatePlansRequest",
 *     @OA\Property(property="id", type="string", format="uuid")
 * )
 */
class UpdatePlansRequest extends FormRequest
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
