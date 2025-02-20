<?php

namespace App\Http\Requests\API\V1\Badges;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *     schema="UpdateBadgesRequest",
 *     @OA\Property(property="id", type="string", format="uuid")
 * )
 */
class UpdateBadgesRequest extends FormRequest
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
