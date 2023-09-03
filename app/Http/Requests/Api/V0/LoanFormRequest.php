<?php

namespace App\Http\Requests\Api\V0;

use App\Http\Requests\Api\FormRequest;

class LoanFormRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'amount' => 'required|numeric|between:0,100000',
            'interest_rate' => 'required|numeric|between:0,100',
            'yearly_term' => 'required|numeric|between:1,35',
            'extra_payment' => 'numeric|min: 0| max: ' . $this->amount,
        ];
    }
}
