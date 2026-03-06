<?php

namespace App\Services;

use App\Models\Pengaturan;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class PengaturanService
{
    protected $pengaturan;

    public function __construct(Pengaturan $pengaturan)
    {
        $this->pengaturan = $pengaturan;
    }

    // Get all Pengaturan
    public function getAllSettings()
    {
        return $this->pengaturan->all();
    }

    // Get Pengaturan by ID
    public function getSettingById($id)
    {
        return $this->pengaturan->find($id);
    }

    // Create a new Pengaturan
    public function createSetting(array $data)
    {
        try {
            return $this->pengaturan->create($data);
        } catch (\Exception $e) {
            Log::error('Failed to create setting: ' . $e->getMessage());
            return null;
        }
    }

    // Update an existing Pengaturan
    public function updateSetting($id, $request)
    {
        $pengaturan = $this->pengaturan->find($id);
        $data = $request->only('nama_toko', 'alamat_toko', 'no_hp_toko', 'koordinat_toko','linkshopee_toko');
        if ($request->hasFile('logo_toko')) {
            if ($pengaturan->logo_toko) {
                Storage::disk('public')->delete($pengaturan->logo_toko);
            }
                $imagePath = $request->file('logo_toko')->store('pengaturan', 'public');
            $data['logo_toko'] = $imagePath;
        }
        $pengaturan->update($data);
    }

    // Delete Pengaturan by ID
    public function deleteSetting($id)
    {
        $setting = $this->pengaturan->find($id);

        if ($setting) {
            try {
                $setting->delete();
                return true;
            } catch (\Exception $e) {
                Log::error('Failed to delete setting: ' . $e->getMessage());
                return false;
            }
        }

        return false;
    }
}
