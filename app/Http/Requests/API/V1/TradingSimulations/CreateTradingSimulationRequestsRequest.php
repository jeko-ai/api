<?php

namespace App\Http\Requests\API\V1\TradingSimulations;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *     schema="CreateTradingSimulationRequestsRequest",
 *     @OA\Property(property="id", type="string", format="uuid")
 * )
 */
class CreateTradingSimulationRequestsRequest extends FormRequest
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
