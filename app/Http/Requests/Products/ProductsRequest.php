<?php

namespace App\Http\Requests\Products;

use Illuminate\Foundation\Http\FormRequest;

class ProductsRequest extends FormRequest
{
    protected $stopOnFirstFailure = true;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'bail|required|max:255',
            'barcode' => 'bail|required|max:255',
            'system_code' => 'bail|required|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'O campo nome é obrigatório.',
            'name.max' => 'O campo nome deve ter no máximo 255 caracteres.',
            'barcode.required' => 'O campo código de barras é obrigatório.',
            'barcode.max' => 'O campo código de barras deve ter no máximo 255 caracteres.',
            'system_code.required' => 'O campo código do sistema é obrigatório.',
            'system_code.max' => 'O campo código do sistema deve ter no máximo 255 caracteres.'
        ];
    }
}
