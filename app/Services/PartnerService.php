<?php

namespace App\Services;

use App\Models\Partner;
use Illuminate\Support\Facades\Storage;

class PartnerService
{
    public function getAllPartners()
    {
        return Partner::all();
    }

    public function storePartner(array $data) // Mengubah tipe parameter menjadi array
    {
        if (isset($data['gambar'])) {
            $imagePath = $data['gambar']->store('partners', 'public');
            $data['gambar'] = $imagePath;
        }

        return Partner::create($data);
    }

    public function updatePartner(array $data, Partner $partner) // Mengubah tipe parameter menjadi array
    {
        if (isset($data['gambar'])) {
            if ($partner->gambar) {
                Storage::disk('public')->delete($partner->gambar);
            }
            $imagePath = $data['gambar']->store('partners', 'public');
            $data['gambar'] = $imagePath;
        }

        $partner->update($data);
    }

    public function deletePartner(Partner $partner)
    {
        if ($partner->gambar) {
            Storage::disk('public')->delete($partner->gambar);
        }
        return $partner->delete();
    }
}
