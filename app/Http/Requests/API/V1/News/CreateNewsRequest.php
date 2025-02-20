<?php

namespace App\Http\Requests\API\V1\News;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *     schema="CreateNewsRequest",
 *     @OA\Property(property="id", type="string", format="uuid")
 * )
 */
class CreateNewsRequest extends FormRequest
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
