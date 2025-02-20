<?php

namespace App\Http\Requests\API\V1\Invitations;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *     schema="CreateInvitationsRequest",
 *     @OA\Property(property="id", type="string", format="uuid")
 * )
 */
class CreateInvitationsRequest extends FormRequest
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
