<?php

namespace App\Services;

use App\Models\heroimage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HeroImageService
{
    public function getAllHeroImages()
    {
        return heroimage::all();
    }

    public function findHeroImageById($id)
    {
        return heroimage::findOrFail($id);
    }

    public function createHeroImage(Request $request)
    {
        $cek = $this->getAllHeroImages();
        $validatedData = $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg',
        ]);
        if($cek->count() >= 4){
            return redirect()
                ->back()
                ->withErrors(['error' => 'Gambar telah mencapai batas maksimal 4.']);
        }

        $file = $request->file('image');
        $path = $file->store('hero-images', 'public');
        if (!$path) {
            return redirect()
                ->back()
                ->withErrors(['error' => 'Failed to store image.']);
        }
        $heroImage = new HeroImage();
        $heroImage->image = $path;
        if (!$heroImage->save()) {
            return redirect()
                ->back()
                ->withErrors(['error' => 'Failed to store hero image.']);
        }

    }

    public function updateHeroImage(Request $request, $id_heroimage)
    {
        $cek = $this->getAllHeroImages()->where('tampilkandiabout',1)->count();
        $heroImage = heroimage::findOrFail($id_heroimage);
        $validatedData = $request->validate([
            'image' => 'image|mimes:jpeg,png,jpg',
        ]);
        if($cek >= 2){
            return redirect()
                ->back()
                ->withErrors(['error' => 'Maksimal Hanya 2 Gambar Yang Dapat Ditampilkan']);
        }
        // Jika ada gambar baru, simpan dan update path
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($heroImage->image) {
                Storage::delete('public/' . $heroImage->image);
            }

            $path = $request->file('image')->store('hero-images', 'public');
            $heroImage->image = $path;
        }
        $heroImage->tampilkandiabout = $request->input('tampilkan_di_about');

        // Simpan perubahan ke database
        $heroImage->save();


    }

    public function deleteHeroImage($id)
    {
        $heroImage = heroimage::findOrFail($id);
        // Hapus gambar dari storage
        Storage::delete('public/' . $heroImage->image);
        // Hapus data hero image dari database
        $heroImage->delete();
    }
}
