<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
{
    
    protected $stopOnFirstFailure = true;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'old_password' => 'bail|required',
            'password' => 'bail|required|min:8|confirmed',
            'password_confirmation' => 'required',
        ];
    }
    
    public function messages(): array
    {
        return [
            'old_password.required' => 'Por favor, informe a senha antiga.',
            'password.required' => 'Por favor, informe a nova senha.',
            'password.min' => 'A nova senha deve ter pelo menos 8 caracteres.',
            'password.confirmed' => 'A confirmação da nova senha não corresponde.',
            'password_confirmation.required' => 'Por favor, confirme a nova senha.',
        ];
    }
}
