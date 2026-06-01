<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'primeiro_nome' => 'required|string|max:255',
            'sobrenome' => 'required|string|max:255',
            'email' => 'required|email|unique:perfis,email',
            'password' => 'required|min:8',
            'provincia_id' => 'required|exists:provincias,id',
            'funcao' => 'required|in:cliente,freelancer',
        ];
    }
}