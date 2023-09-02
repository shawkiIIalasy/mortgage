<?php

namespace App\Http\Requests\Api\V0;

use App\Http\Requests\Api\FormRequest;

class LoanExtraPaymentFormRequest extends FormRequest
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
            'amount' => 'required|numeric|between:0,100000'
        ];
    }
}
