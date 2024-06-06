<?php

namespace App\Http\Requests\Cashier;

use Illuminate\Foundation\Http\FormRequest;

class OpenCashierRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'cashier_id' => 'bail|required|numeric',
            'master_password' => 'bail|required',
        ];
    }
    
    public function messages(): array
    {
        return [
            'cashier_id.required' => 'Não foi informado o Id deste caixa',
            'cashier_id.numeric' => 'O Id do caixa deve ser um número.',
            'master_password.required' => 'Informe a senha de administrador para abrir o caixa',
        ];
    }
}
