<?php

namespace App\Http\Requests\API\V1\Profiles;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *     schema="UpdateProfilesRequest",
 *     @OA\Property(property="id", type="string", format="uuid")
 * )
 */
class UpdateProfilesRequest extends FormRequest
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
