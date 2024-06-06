<?php

namespace App\Http\Requests\Cashier;

use Illuminate\Foundation\Http\FormRequest;

class UpdateItemRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'update_cashier_product_id' => 'bail|required|numeric',
            'update_new_quantity' => 'bail|required|numeric',
        ];
    }
    
    public function messages(): array
    {
        return [
            'update_cashier_product_id.required' => 'Não foi informado o Id deste item',
            'update_cashier_product_id.numeric' => 'O Id do item deve ser um número.',
            'update_new_quantity.required' => 'Não foi informado nenhuma quantidade para este item',
            'update_new_quantity.numeric' => 'O campo de quantidade deve ser um número.',
        ];
    }
}
