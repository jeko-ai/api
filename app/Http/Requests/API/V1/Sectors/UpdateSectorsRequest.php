<?php

namespace App\Http\Requests\API\V1\Sectors;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *     schema="UpdateSectorsRequest",
 *     @OA\Property(property="id", type="string", format="uuid")
 * )
 */
class UpdateSectorsRequest extends FormRequest
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
