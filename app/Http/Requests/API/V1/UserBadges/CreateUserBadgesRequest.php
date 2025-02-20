<?php

namespace App\Http\Requests\API\V1\UserBadges;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *     schema="CreateUserBadgesRequest",
 *     @OA\Property(property="id", type="string", format="uuid")
 * )
 */
class CreateUserBadgesRequest extends FormRequest
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
