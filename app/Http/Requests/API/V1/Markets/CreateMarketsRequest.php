<?php

namespace App\Http\Requests\API\V1\Markets;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *     schema="CreateMarketsRequest",
 *     @OA\Property(property="id", type="string", format="uuid")
 * )
 */
class CreateMarketsRequest extends FormRequest
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
