<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateArtikel extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'judul' => [
                'required',
                'string',
                'max:255',
            ],
            'isi' => 'required|string',
            'gambar' => 'image|mimes:jpg,png,jpeg',
            'tags' => 'required|array',
            'tags.*' => 'required|string|max:100',
        ];
    }

    public function messages()
    {
        return [
            'judul.required' => 'Judul wajib diisi.',
            'judul.string' => 'Judul harus berupa string.',
            'judul.max' => 'Judul tidak boleh lebih dari 255 karakter.',
            'isi.required' => 'Isi artikel wajib diisi.',
            'isi.string' => 'Isi artikel harus berupa string.',
            'gambar.image' => 'File gambar harus berupa gambar.',
            'gambar.mimes' => 'Gambar harus berformat jpg, png, atau jpeg.',
            'gambar.max' => 'Ukuran gambar maksimal 2MB.',
            'tags.required' => 'Setidaknya satu tag wajib dipilih.',
            'tags.array' => 'Tags harus berupa array.',
            'tags.*.required' => 'Tag wajib diisi.',
            'tags.*.string' => 'Tag harus berupa string.',
            'tags.*.max' => 'Tag tidak boleh lebih dari 100 karakter.',
        ];
    }
}
