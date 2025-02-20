<?php

namespace App\Http\Requests\API\V1\Subscriptions;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *     schema="CreateSubscriptionsRequest",
 *     @OA\Property(property="id", type="string", format="uuid")
 * )
 */
class CreateSubscriptionsRequest extends FormRequest
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
