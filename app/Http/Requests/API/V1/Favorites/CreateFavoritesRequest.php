<?php

namespace App\Http\Requests\API\V1\Favorites;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *     schema="CreateFavoritesRequest",
 *     @OA\Property(property="id", type="string", format="uuid")
 * )
 */
class CreateFavoritesRequest extends FormRequest
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
