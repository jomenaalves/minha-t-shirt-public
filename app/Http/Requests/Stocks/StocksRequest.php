<?php

namespace App\Http\Requests\Stocks;

use Illuminate\Foundation\Http\FormRequest;

class StocksRequest extends FormRequest
{
    protected $stopOnFirstFailure = true;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'action' => 'bail|required|string',
            'warehouse_id' => 'bail|required',
            'products' => 'bail|required|json|not_in:[]',
            'observation' => 'bail|nullable|string',
        ];
    }

    public function messages(): array
    {
        return [
            'warehouse_id.required' => 'Não foi possível encontrar o estoque. Por favor, tente novamente.',
            'products.required' => 'Nenhum produto foi encontrado. Por favor, tente novamente.',
            'action.required' => 'Algo de errado aconteceu. Por favor, tente novamente.',
            'products.not_in' => 'Nenhum produto foi adicionado. Por favor, tente novamente.',        
        ];
    }
}
