<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePengaturanRequest extends FormRequest
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
            'nama_toko' => 'required|string|max:255',
            'alamat_toko' => 'required|string|max:500',
            'no_hp_toko' => 'required|string|max:15',
            'koordinat_toko' => 'required|string',
            'logo_toko' => 'required|image|mimes:jpeg,png,jpg',
            'linkshopee_toko' => 'required|url|max:255',
        ];
    }

    public function messages()
    {
        return [
            'nama_toko.required' => 'Nama toko wajib diisi.',
            'alamat_toko.required' => 'Alamat toko wajib diisi.',
            'no_hp_toko.required' => 'Nomor HP toko wajib diisi.',
            'logo_toko.image' => 'Logo toko harus berupa file gambar.',
            'linkshopee_toko.url' => 'Link Shopee toko harus berupa URL yang valid.',
        ];
    }
}
