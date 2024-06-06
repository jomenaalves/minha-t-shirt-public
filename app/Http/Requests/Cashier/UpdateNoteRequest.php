<?php

namespace App\Http\Requests\Cashier;

use Illuminate\Foundation\Http\FormRequest;

class UpdateNoteRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'cashier_id' => 'bail|required|numeric',
            'note' => 'bail|required|string',
        ];
    }
    
    public function messages(): array
    {
        return [
            'cashier_id.required' => 'Não foi informado o Id deste caixa',
            'cashier_id.numeric' => 'O Id do caixa deve ser um número.',
            'note.required' => 'Não foi informado nenhum texto de observação do caixa',
            'note.string' => 'O campo de observação deve ser um texto.',
        ];
    }
}
