<?php

namespace App\Http\Requests\API\V1\Badges;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *     schema="CreateBadgesRequest",
 *     @OA\Property(property="id", type="string", format="uuid")
 * )
 */
class CreateBadgesRequest extends FormRequest
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
