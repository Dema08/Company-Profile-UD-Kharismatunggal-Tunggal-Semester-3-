<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePartnerRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nama' => 'required|string|max:255',
            'gambar' => 'required|image|mimes:jpeg,png,jpg',
        ];
    }

    public function messages()
    {
        return [
            'nama.required' => 'Nama partner harus diisi.',
            'nama.string' => 'Nama partner harus berupa teks.',
            'nama.max' => 'Nama partner tidak boleh lebih dari 255 karakter.',
            'gambar.required' => 'Gambar partner harus diunggah.',
            'gambar.image' => 'File yang diunggah harus berupa gambar.',
            'gambar.mimes' => 'Gambar harus memiliki format jpeg, png, atau jpg.',
        ];
    }
}
