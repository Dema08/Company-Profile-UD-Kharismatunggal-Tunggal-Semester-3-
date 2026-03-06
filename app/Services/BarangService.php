<?php

namespace App\Services;

use App\Models\Barang;
use App\Models\detailkategoribarang;
use App\Models\GalleryBarang;
use Illuminate\Support\Facades\Storage;
use App\Services\KategoribarangService;

class BarangService
{
    private $kategoribarangservice;

    public function __construct(KategoribarangService $kategoribarangservice)
    {
        $this->kategoribarangservice = $kategoribarangservice;
    }

    public function getAllBarangs()
    {
        return Barang::with('gallery', 'kategori', 'ulasan', 'ulasan.pengguna', 'kategori.kategoriBarang');
    }


    public function searchbarang($data)
    {
        $kategori = $data->kategori ?? null;
        $urutkan = ($data->urutkan == 'asc' ? 'asc' : 'desc');
        $search = $data->search ?? null;
        $query = $this->getAllBarangs()->where('is_visible', '1');


        if ($kategori !== null) {
            $query->whereHas('kategori', function ($query) use ($kategori) {
                $query->where('id_kategori_barang', $kategori);
            });
        }
        $query->orderBy('nama_barang', $urutkan);
        if ($search !== null) {
            $query->where('nama_barang', 'like', '%' . $search . '%')
                ->orWhere('deskripsi_singkat', 'like', '%' . $search . '%')
                ;
        }

        return $query->where('is_visible', '1');
    }

    public function createBarang(array $data)
    {
        if (!isset($data['id_kategori_barang'])) {
            throw new \Exception('ID Kategori Barang harus disertakan.');
        }


        $barang = Barang::create([
            'nama_barang' => $data['nama_barang'],
            'deskripsi_singkat' => $data['deskripsi_singkat'],
            'deskripsi' => $data['deskripsi'],
            'harga_barang' => $data['harga_barang'],
            'link_shopee' => $data['link_shopee'],
            'is_visible' => $data['is_visible'],
        ]);

        if (isset($data['id_kategori_barang']) && is_array($data['id_kategori_barang'])) {
            foreach ($data['id_kategori_barang'] as $kategori) {
                detailkategoribarang::create([
                    'id_barang' => $barang->id_barang,
                    'id_kategori_barang' => $kategori,
                ]);
            }
        }

        if (isset($data['images']) && is_array($data['images'])) {
            foreach ($data['images'] as $file) {
                $path = $file->store('gallery_barang', 'public');
                GalleryBarang::create([
                    'id_barang' => $barang->id_barang,
                    'path_gambar' => $path,
                ]);
            }
        }

        return $barang;
    }

    public function updateBarang(array $data, Barang $barang)
{
    // Update informasi barang
    $barang->update($data);

    // Update kategori
    if (isset($data['id_kategori_barang']) && is_array($data['id_kategori_barang'])) {
        detailkategoribarang::where('id_barang', $barang->id_barang)
            ->whereNotIn('id_kategori_barang', $data['id_kategori_barang'])
            ->delete();

        foreach ($data['id_kategori_barang'] as $kategoriId) {
            detailkategoribarang::firstOrCreate([
                'id_barang' => $barang->id_barang,
                'id_kategori_barang' => $kategoriId,
            ]);
        }
    }

    // Hapus gambar yang dipilih
    if (isset($data['delete_images']) && is_array($data['delete_images'])) {
        foreach ($data['delete_images'] as $imageId) {
            $galleryImage = GalleryBarang::where('id_barang', $barang->id_barang)->find($imageId);
            if ($galleryImage) {
                // Hapus gambar dari storage
                Storage::disk('public')->delete($galleryImage->path_gambar);
                // Hapus entri gambar dari database
                $galleryImage->delete();
            }
        }
    }

    // Perbarui gambar yang diubah
    if (isset($data['edit_images']) && is_array($data['edit_images'])) {
        foreach ($data['edit_images'] as $imageId => $file) {
            if ($file) {
                $galleryImage = GalleryBarang::find($imageId);
                if ($galleryImage) {
                    // Hapus gambar lama dari storage
                    Storage::disk('public')->delete($galleryImage->path_gambar);

                    // Simpan gambar baru
                    $path = $file->store('gallery_barang', 'public');
                    $galleryImage->path_gambar = $path;
                    $galleryImage->save();
                }
            }
        }
    }

    // Cek jumlah gambar yang sudah ada
    $existingImagesCount = GalleryBarang::where('id_barang', $barang->id_barang)->count();

    // Tambah gambar baru hanya jika jumlah gambar belum mencapai 4
    if (isset($data['images']) && is_array($data['images']) && !empty($data['images'])) {
        $totalImagesToAdd = count($data['images']);
        $remainingSlots = 4 - $existingImagesCount;

        if ($remainingSlots > 0) {
            foreach ($data['images'] as $file) {
                if ($totalImagesToAdd <= $remainingSlots) {
                    $path = $file->store('gallery_barang', 'public');
                    if (!GalleryBarang::where('id_barang', $barang->id_barang)->where('path_gambar', $path)->exists()) {
                        GalleryBarang::create([
                            'id_barang' => $barang->id_barang,
                            'path_gambar' => $path,
                        ]);
                    }
                } else {
                    break; // Jangan tambah lebih dari jumlah slot yang tersedia
                }
            }
        }
    }

    return $barang;
}


    public function deleteBarang(Barang $barang)
    {
        $images = GalleryBarang::where('id_barang', $barang->id_barang)->get();
        foreach ($images as $image) {
            Storage::disk('public')->delete($image->path_gambar);
            $image->delete();
        }

        $barang->delete();
    }
}
