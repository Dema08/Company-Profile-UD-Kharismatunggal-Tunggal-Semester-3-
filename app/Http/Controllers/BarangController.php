<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategoribarang;
use App\Services\BarangService;
use App\Http\Requests\StoreBarang;
use App\Http\Requests\UpdateBarang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    protected $barangService;

    public function __construct(BarangService $barangService)
    {
        $this->barangService = $barangService;
    }

    public function index()
    {
        $barangs = $this->barangService->getAllBarangs()->get();
        $title = 'Hapus Data Barang';
        $text = "Apakah anda yakin ingin menghapus data ini?";
        confirmDelete($title, $text);
        return view('admin.barang.index', compact('barangs'));
    }

    public function create()
    {
        $kategoris = Kategoribarang::all();
        return view('admin.barang.create', compact('kategoris'));
    }

    public function store(StoreBarang $request)
    {
        $data = $request->validated();
        $data['id_kategori_barang'] = $request->input('id_kategori_barang');
        $data['images'] = $request->file('images') ?? [];
        $this->barangService->createBarang($data);
        toast('Barang berhasil ditambahkan','success');
        return redirect()->route('barang.index')->with('success', 'Barang berhasil ditambahkan.');
    }


    public function edit($id)
    {
        $barang = $this->barangService->getAllBarangs()->where('id_barang', $id)->first();
        $kategoris = Kategoribarang::all();
        return view('admin.barang.edit', compact('barang', 'kategoris'));
    }

    public function update(UpdateBarang $request, Barang $barang)
{
    $data = $request->validated();
    $data['id_kategori_barang'] = $request->input('id_kategori_barang');
    $data['edit_images'] = $request->file('edit_images') ?? [];
    $data['delete_images'] = $request->input('delete_images') ?? [];
    $data['images'] = $request->file('images') ?? [];

    $data['is_visible'] = $request->input('is_visible');

    $existingImagesCount = $barang->gallery()->count();

    $totalImages = $existingImagesCount + count($data['images']);

    if ($totalImages > 4) {
        return redirect()->back()
            ->withErrors(['images' => 'Gambar yang diunggah melebihi batas maksimal. Anda hanya dapat memiliki maksimal 4 gambar.'])
            ->withInput();
    }

    $this->barangService->updateBarang($data, $barang);
    toast('Barang berhasil diperbarui','success');
    return redirect()->route('barang.index')->with('success', 'Barang berhasil diperbarui.');
}


    public function destroy(Barang $barang)
    {
        $this->barangService->deleteBarang($barang);
        toast('Barang berhasil dihapus','success');
        return redirect()->route('barang.index')->with('success', 'Barang berhasil dihapus.');
    }
}
