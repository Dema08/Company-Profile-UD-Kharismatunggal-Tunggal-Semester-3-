<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRegister extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'email' => 'required|email|unique:tb_datapengguna|max:255',
            'nama_pengguna' => 'required',
            'password' => 'required|min:6|same:confirm_password'
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'Email diperlukan',
            'email.email' => 'Email tidak valid',
            'email.unique' => 'Email sudah terdaftar',
            'nama_pengguna.required' => 'Nama pengguna diperlukan',
            'password.required' => 'Password diperlukan',
            'password.min' => 'Password harus memiliki minimal 6 karakter',
            'password.same' => 'Password harus sama dengan confirm password',
        ];
    }
}
