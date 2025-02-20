<?php

namespace App\Http\Requests\API\V1\UserLevels;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *     schema="CreateUserLevelsRequest",
 *     @OA\Property(property="id", type="string", format="uuid")
 * )
 */
class CreateUserLevelsRequest extends FormRequest
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
