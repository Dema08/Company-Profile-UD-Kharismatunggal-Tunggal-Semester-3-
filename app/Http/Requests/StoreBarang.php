<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\MaxWords;

class StoreBarang extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nama_barang' => 'required|string|max:100|unique:tb_data_barang,nama_barang',
            'deskripsi' => ['required', 'string'],
            'deskripsi_singkat' => ['required', 'string', 'max:400'],
            'harga_barang' => 'required|numeric',
            'link_shopee' => 'nullable|url',
            'images' => 'nullable|array|max:4',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg',
            'id_kategori_barang' => 'required|exists:tb_kategori_barang,id_kategori_barang',
            'is_visible' => 'required',
        ];
    }

    public function messages()
{
    return [
        'nama_barang.required' => 'Nama barang harus diisi.',
        'nama_barang.string' => 'Nama barang harus berupa teks.',
        'nama_barang.max' => 'Nama barang tidak boleh lebih dari 100 karakter.',
        'nama_barang.unique' => 'Nama barang sudah digunakan, pilih nama yang lain.',
        'deskripsi.required' => 'Deskripsi harus diisi.',
        'deskripsi.string' => 'Deskripsi harus berupa teks.',
        'deskripsi_singkat.required' => 'Deskripsi singkat harus diisi.',
        'deskripsi_singkat.string' => 'Deskripsi singkat harus berupa teks.',
        'deskripsi_singkat.max' => 'Deskripsi singkat tidak boleh lebih dari 400 karakter.',
        'harga_barang.required' => 'Harga barang harus diisi.',
        'harga_barang.numeric' => 'Harga barang harus berupa angka.',
        'link_shopee.url' => 'Link Shopee harus berupa URL yang valid.',
        'link_WA.url' => 'Link WhatsApp harus berupa URL yang valid.',
        'images.array' => 'Gambar harus berupa array.',
        'images.max' => 'Gambar tidak boleh lebih dari 5 file.',
        'images.*.image' => 'File harus berupa gambar.',
        'images.*.mimes' => 'File gambar harus berformat jpeg, png, atau jpg.',
        'id_kategori_barang.required' => 'Kategori barang harus dipilih.',
        'id_kategori_barang.exists' => 'Kategori barang tidak ditemukan.',
    ];
}
}
