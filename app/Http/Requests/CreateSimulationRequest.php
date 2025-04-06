<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class CreateSimulationRequest extends FormRequest
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
            'market_id' => 'required|uuid|exists:markets,id',
            'symbols' => 'required_if:selected_type,user|array',
            'symbols.*' => 'required_if:selected_type,user|uuid|exists:symbols,id',
            'sectors' => 'required_if:selected_type,ai|array',
            'sectors.*' => 'required_if:selected_type,user|uuid|exists:sectors,id',
            'investment_amount' => 'required|numeric|min:0',
            'risk_level' => 'required|in:low,medium,high',
            'duration' => 'required|in:daily,weekly,monthly,quarterly,annually,range',
            'strategy' => 'required|in:day_trading,swing_trading,long_term',
            'start_time' => 'required|date|after_or_equal:tomorrow',
            'end_time' => 'required|date|after:start_time',
            'expected_return_percentage' => 'required|numeric|min:0|max:100',
            'stop_loss_percentage' => 'required|numeric|min:0|max:100',
            'selected_type' => 'required|in:ai,user',
        ];
    }
}
