<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UploadPhotoUserRequest extends FormRequest
{

    protected $stopOnFirstFailure = true;

    public function authorize(): bool
    {
        return true;
    }

     public function rules()
    {
        return [
            'photo' => 'required|file|max:5120|mimes:jpg,jpeg,png,gif,webp',
        ];
    }

    public function messages()
    {
        return [
            'photo.required' => 'Por favor, selecione uma imagem.',
            'photo.file' => 'O arquivo selecionado não é uma imagem válida.',
            'photo.max' => 'A imagem não pode ser maior que 5MB.',
            'photo.mimes' => 'Por favor, selecione uma imagem nos formatos JPG, JPEG, PNG, GIF ou WEBP.',
        ];
    }
}
