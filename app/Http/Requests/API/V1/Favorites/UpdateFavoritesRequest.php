<?php

namespace App\Http\Requests\API\V1\Favorites;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *     schema="UpdateFavoritesRequest",
 *     @OA\Property(property="id", type="string", format="uuid")
 * )
 */
class UpdateFavoritesRequest extends FormRequest
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
