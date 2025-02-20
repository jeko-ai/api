<?php

namespace App\Http\Requests\API\V1\Challenges;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *     schema="UpdateChallengesRequest",
 *     @OA\Property(property="id", type="string", format="uuid")
 * )
 */
class UpdateChallengesRequest extends FormRequest
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
