<?php

namespace App\Http\Requests\API\V1;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class CreatePredictionRequest extends FormRequest
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
            'prediction_type' => 'required|string|in:daily,weekly,monthly,quarterly,annually,range',
            'prediction_start_date' => 'required|after:today',
            'prediction_end_date' => 'required|after:prediction_start_date',
        ];
    }
}
