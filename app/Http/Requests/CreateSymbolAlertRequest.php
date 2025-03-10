<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class CreateSymbolAlertRequest extends FormRequest
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
            'id' => 'required|uuid|exists:symbols,id',
            'enable_price_alert' => 'nullable|boolean',
            'price_alert' => 'nullable|numeric',
            'new_recommendation' => 'nullable|boolean',
            'latest_news' => 'nullable|boolean',
            'new_predictions' => 'nullable|boolean',
            'unusual_volume_alert' => 'nullable|boolean',
            'volatility_alert' => 'nullable|boolean',
            'earnings_report_alert' => 'nullable|boolean',
            'analyst_rating_alert' => 'nullable|boolean',
            'corporate_events_alert' => 'nullable|boolean',
            'market_movement_alert' => 'nullable|boolean',
            'ai_smart_alert' => 'nullable|boolean',
        ];
    }
}
