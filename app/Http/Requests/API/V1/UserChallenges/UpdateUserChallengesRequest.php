<?php

namespace App\Http\Requests\API\V1\UserChallenges;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *     schema="UpdateUserChallengesRequest",
 *     @OA\Property(property="id", type="string", format="uuid")
 * )
 */
class UpdateUserChallengesRequest extends FormRequest
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
