<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLogin extends FormRequest
{
    public function authorize()
    {
        return true; // Ubah ini jika Anda memiliki kebijakan otorisasi khusus
    }

    public function rules()
    {
        return [
            'email' => 'required|email',
            'password' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'Email diperlukan',
            'email.email' => 'Email tidak valid',
            'password.required' => 'Password diperlukan'
        ];
    }
}
