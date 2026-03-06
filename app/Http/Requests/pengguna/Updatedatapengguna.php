<?php

namespace App\Http\Requests\pengguna;

use Illuminate\Foundation\Http\FormRequest;

class Updatedatapengguna extends FormRequest
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
            'email' => 'required',
        ];
    }
    public function messages(){
        return [
            'nama_pengguna.required' => 'Nama pengguna wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
        ];
    }
}
