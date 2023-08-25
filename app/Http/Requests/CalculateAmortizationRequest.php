<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CalculateAmortizationRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
                'loan_amount'          => 'required|numeric|min:0',
                'annual_interest_rate' => 'required|numeric|min:0',
                'loan_term'            => 'required|integer|min:1',
        ];
    }
}
