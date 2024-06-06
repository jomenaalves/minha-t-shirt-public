<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    
    protected $stopOnFirstFailure = true;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'bail|required|min:3|max:100',
            'username' => 'bail|required|min:3|max:25',
            'function' => 'required',
        ];
    }
    
    public function messages(): array
    {
        return [
            'name.required' => 'Por favor, preencha o campo "Nome"',
            'name.min' => 'O campo Nome deve ter no mínimo 3 caracteres.',
            'name.max' => 'O campo Nome deve ter no máximo 100 caracteres.',
    
            'username.required' => 'Por favor, preencha o campo "Nome de usuário"',
            'username.min' => 'O campo Nome de usuário deve ter no mínimo 3 caracteres',
            'username.max' => 'O campo Nome de usuário deve ter no máximo 25 caracteres',
    
            'function.required' => 'Por favor, preencha o campo "Função"',
        ];
    }
}
