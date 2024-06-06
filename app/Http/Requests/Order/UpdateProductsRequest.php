<?php

namespace App\Http\Requests\Order;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'product_id' => 'bail|required',
            'price' => 'bail|required',
            'quantity' => 'bail|required',
        ];
    }
    
    public function messages(): array
    {
        return [
            'product_id.required' => 'Não foi informado o o produto a ser inserido',
            'price.required' => 'Informe o valor do produto',
            'quantity.required' => 'Informe a quantidade de produto',
        ];
    }
}
