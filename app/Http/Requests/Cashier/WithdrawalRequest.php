<?php

namespace App\Http\Requests\Cashier;

use Illuminate\Foundation\Http\FormRequest;

class WithdrawalRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'cashier_id' => 'bail|required|numeric',
            'value_withdrawal' => 'bail|required|numeric',
            'description_withdrawal' => 'bail|required|string',
        ];
    }
    
    public function messages(): array
    {
        return [
            'cashier_id.required' => 'Não foi informado o Id deste caixa',
            'cashier_id.numeric' => 'O Id do caixa deve ser um número.',
            'value_withdrawal.required' => 'Não foi informado valor da retirada.',
            'value_withdrawal.numeric' => 'O valor da retirada deve ser um número.',
            'description_withdrawal.required' => 'Não foi informado a descrição da retirada.',
            'description_withdrawal.string' => 'O campo descrição deve ser um texto.',
        ];
    }
}
