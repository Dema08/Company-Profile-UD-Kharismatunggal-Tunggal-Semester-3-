<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTagArtikel extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nama_tag' => 'required|string|max:100|unique:tb_tag_artikel,nama_tag',
        ];
    }

    public function messages()
    {
        return [
            'nama_tag.required' => 'Nama tag wajib diisi.',
            'nama_tag.string' => 'Nama tag harus berupa string.',
            'nama_tag.max' => 'Nama tag maksimal 100 karakter.',
            'nama_tag.unique' => 'Nama tag sudah digunakan, pilih nama yang lain.',
        ];
    }
}
