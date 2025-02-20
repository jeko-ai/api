<?php

namespace App\Http\Requests\API\V1\ContactUs;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *     schema="CreateContactUsRequest",
 *     @OA\Property(property="id", type="string", format="uuid")
 * )
 */
class CreateContactUsRequest extends FormRequest
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
