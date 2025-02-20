<?php

namespace App\Http\Requests\API\V1\PortfolioTransactions;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *     schema="CreatePortfolioTransactionsRequest",
 *     @OA\Property(property="id", type="string", format="uuid")
 * )
 */
class CreatePortfolioTransactionsRequest extends FormRequest
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
