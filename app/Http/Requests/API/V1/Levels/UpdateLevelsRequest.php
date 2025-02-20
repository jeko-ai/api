<?php

namespace App\Http\Requests\API\V1\Levels;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *     schema="UpdateLevelsRequest",
 *     @OA\Property(property="id", type="string", format="uuid")
 * )
 */
class UpdateLevelsRequest extends FormRequest
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
