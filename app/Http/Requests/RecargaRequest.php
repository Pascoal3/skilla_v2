<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RecargaRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'valor' => ['required', 'numeric', 'min:500'],
        ];
    }
}