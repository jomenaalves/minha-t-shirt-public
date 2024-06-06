<?php

namespace App\Http\Requests\Warehouses;

use Illuminate\Foundation\Http\FormRequest;

class UpdateWarehousesRequest extends FormRequest
{
    protected $stopOnFirstFailure = true;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'warehouse_id' => 'bail|required',
            'description' => 'bail|required|string|max:100|min:3',
            'zipcode' => 'bail|required|string|max:8|min:8',
            'address' => 'bail|required',
            'number' => 'bail|required',
            'complement' => 'bail|nullable',
            'neighborhood' => 'bail|required',
            'city' => 'bail|required',
            'state' => 'bail|required',
            'color' => 'bail|required|string|max:7|min:7',
        ];
    }

    public function messages(): array
    {
        return [
            'description.required' => 'O campo nome/descrição é obrigatório.',
            'description.max' => 'O campo descrição deve ter no máximo 100 caracteres.',
            'description.min' => 'O campo descrição deve ter no mínimo 3 caracteres.',
            'zipcode.required' => 'O campo CEP é obrigatório.',
            'address.required' => 'O campo endereço é obrigatório.',
            'number.required' => 'O campo número é obrigatório.',
            'neighborhood.required' => 'O campo bairro é obrigatório.',
            'city.required' => 'O campo cidade é obrigatório.',
            'state.required' => 'O campo estado é obrigatório.',
            'color.required' => 'O campo cor é obrigatório.',
        ];
    }
}
