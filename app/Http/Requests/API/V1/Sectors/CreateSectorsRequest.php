<?php

namespace App\Http\Requests\API\V1\Sectors;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *     schema="CreateSectorsRequest",
 *     @OA\Property(property="id", type="string", format="uuid")
 * )
 */
class CreateSectorsRequest extends FormRequest
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
