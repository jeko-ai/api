<?php

namespace App\Http\Requests\API\V1\Rewards;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *     schema="CreateRewardsRequest",
 *     @OA\Property(property="id", type="string", format="uuid")
 * )
 */
class CreateRewardsRequest extends FormRequest
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
