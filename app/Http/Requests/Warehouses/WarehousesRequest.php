<?php

namespace App\Http\Requests\Warehouses;

use Illuminate\Foundation\Http\FormRequest;

class WarehousesRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected $stopOnFirstFailure = true;

    protected function prepareForValidation(): void
    {
        $this->merge([
            'zipcode' => preg_replace('/[^0-9]/', '', $this->zipcode),
        ]);
    }

    public function rules(): array
    {
        return [
            'description' => 'required|string|max:100|min:3',
            'zipcode' => 'required|string|max:8|min:8',
            'address' => 'required',
            'number' => 'required',
            'complement' => 'nullable',
            'neighborhood' => 'required',
            'city' => 'required',
            'state' => 'required',
            'color' => 'required|string|max:7|min:7',
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
        ];
    }
}
