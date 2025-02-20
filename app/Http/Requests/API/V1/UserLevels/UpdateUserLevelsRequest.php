<?php

namespace App\Http\Requests\API\V1\UserLevels;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *     schema="UpdateUserLevelsRequest",
 *     @OA\Property(property="id", type="string", format="uuid")
 * )
 */
class UpdateUserLevelsRequest extends FormRequest
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
