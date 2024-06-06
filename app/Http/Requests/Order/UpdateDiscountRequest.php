<?php

namespace App\Http\Requests\Order;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDiscountRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'freight' => 'bail|required',
            'payment-type' => 'bail|required',
            'amount' => 'bail|required',
            'discount_value' => 'bail|required',
        ];
    }
    
    public function messages(): array
    {
        return [
            'freight.required' => 'Não foi informado o valor do frete',
            'payment-type.required' => 'Informe o tipo de frete',
            'amount.required' => 'Informe o valor total de produtos',
            'discount_value.required' => 'Não foi informado o valor do disconto',
        ];
    }
}
