<?php

namespace App\Http\Requests\Order;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAddressRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'cep' => 'bail|required',
            'address' => 'bail|required',
            'number' => 'bail|required|numeric',
            'neighborhood' => 'bail|required',
            'city' => 'bail|required',
            'state' => 'bail|required',
        ];
    }
    
    public function messages(): array
    {
        return [
            'cep.required' => 'Não foi informado o CEP do endereço',
            'address.required' => 'Informe o logradouro',
            'number.required' => 'Não foi informado nenhum número',
            'number.numeric' => 'O campo número deve conter apenas números',
            'neighborhood.required' => 'Não foi informado nenhum bairro',
            'city.required' => 'Não foi informado nenhuma cidade',
            'state.required' => 'Não foi informado nenhum estado',
        ];
    }
}
