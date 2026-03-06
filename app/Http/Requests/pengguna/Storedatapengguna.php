<?php

namespace App\Http\Requests\pengguna;

use Illuminate\Foundation\Http\FormRequest;

class Storedatapengguna extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'nama_pengguna' => 'required|String',
            'email' => 'required|email|unique:tb_datapengguna,email',
            'password' => 'required|min:6',
            'alamat' => 'required|String',
            'no_telp' => 'required|numeric',
            'role' => 'String',
        ];
    }
    public function messages(){
        return [
            'nama_pengguna.required' => 'Nama pengguna wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah digunakan.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 6 karakter.',
            'alamat.required' => 'Alamat wajib diisi.',
            'no_telp.required' => 'Nomor telepon wajib diisi.',
            'no_telp.numeric' => 'Nomor telepon harus berupa angka.',
            'role.required' => 'Role wajib diisi.',
        ];
    }
}
