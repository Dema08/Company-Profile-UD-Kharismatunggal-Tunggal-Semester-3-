<?php

namespace App\Services;

use App\Models\Ulasan;
use Illuminate\Support\Facades\Storage;

class UlasanService
{
    public function getallulasan()
    {
        return Ulasan::with('pengguna', 'barang');
    }

    public function find($id)
    {
        return Ulasan::find($id);
    }

    public function create($data)
    {
        return Ulasan::create($data);
    }

    public function update($id, $data)
    {
        $ulasan = $this->find($id);
        if ($ulasan) {
            $ulasan->update($data);
            return $ulasan;
        }
        return null;
    }

    public function delete($id)
    {
        $ulasan = $this->find($id);
        if ($ulasan) {
            $ulasan->delete();
            return true;
        }
        return false;
    }
}
