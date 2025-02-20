<?php

namespace App\Http\Requests\API\V1\PortfolioAssets;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *     schema="CreatePortfolioAssetsRequest",
 *     @OA\Property(property="id", type="string", format="uuid")
 * )
 */
class CreatePortfolioAssetsRequest extends FormRequest
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
