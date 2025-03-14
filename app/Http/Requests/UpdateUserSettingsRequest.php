<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserSettingsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'sometimes|string|max:255',
            'language' => 'sometimes|string|max:10',
            'risk_level' => 'sometimes|in:low,medium,high',
            'country_id' => 'sometimes|uuid|exists:countries,id',
            'is_notification_enabled' => 'sometimes|boolean',
            'is_price_alerts_enabled' => 'sometimes|boolean',
            'is_new_recommendations_alerts_enabled' => 'sometimes|boolean',
            'is_portfolio_update_alerts_enabled' => 'sometimes|boolean',
            'is_market_sentiment_alerts_enabled' => 'sometimes|boolean',
        ];
    }
}
