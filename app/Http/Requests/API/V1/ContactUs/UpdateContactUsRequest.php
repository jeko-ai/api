<?php

namespace App\Http\Requests\API\V1\ContactUs;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *     schema="UpdateContactUsRequest",
 *     @OA\Property(property="id", type="string", format="uuid")
 * )
 */
class UpdateContactUsRequest extends FormRequest
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
