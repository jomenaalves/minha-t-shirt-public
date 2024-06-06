<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class AuthRequest extends FormRequest
{

    protected $stopOnFirstFailure = true;
    
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'username' => 'bail|required|exists:users,username',
            'password' => 'required'
        ];
    }

    public function messages(): array
    {
        return [
            'username.required' => 'Infome o username',
            'username.exists' => 'Username ou senha inválidos',
            'password.required' => 'Informe a senha'
        ];
    }
}
