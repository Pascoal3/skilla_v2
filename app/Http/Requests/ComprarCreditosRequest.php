<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ComprarCreditosRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'pacote_id' => ['required', 'string'],
        ];
    }
}