<?php

namespace App\Services;

use App\Models\Kategoribarang;

class KategoribarangService
{
    public function getAllKategoribarangs()
    {
        return Kategoribarang::all();
    }

    public function createKategoribarang(array $data)
    {
        return Kategoribarang::create($data);
    }

    public function updateKategoribarang(array $data, Kategoribarang $kategoribarang)
    {
        return $kategoribarang->update($data);
    }

    public function deleteKategoribarang(Kategoribarang $kategoribarang)
    {
        return $kategoribarang->delete();
    }
}
