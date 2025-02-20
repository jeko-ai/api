<?php

namespace App\Http\Requests\API\V1\PortfolioAssets;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *     schema="UpdatePortfolioAssetsRequest",
 *     @OA\Property(property="id", type="string", format="uuid")
 * )
 */
class UpdatePortfolioAssetsRequest extends FormRequest
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
