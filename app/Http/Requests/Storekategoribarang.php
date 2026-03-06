<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Storekategoribarang extends FormRequest
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
            'nama' => 'required|string|max:255|unique:tb_kategori_barang,nama'
        ];
    }
    public function messages()
    {
        return [
            'nama.required' => 'Nama kategori harus diisi.',
            'nama.string' => 'Nama kategori harus berupa teks.',
            'nama.max' => 'Nama kategori tidak boleh lebih dari 255 karakter.',
            'nama.unique' => 'Nama kategori sudah ada.',
        ];
    }
}
