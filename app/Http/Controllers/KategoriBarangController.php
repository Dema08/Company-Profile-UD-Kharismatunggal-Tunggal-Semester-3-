<?php

namespace App\Http\Controllers;

use App\Models\Kategoribarang;
use App\Services\KategoribarangService;
use Illuminate\Http\Request;
use App\Http\Requests\Storekategoribarang;
use App\Http\Requests\Updatekategoribarang;

class KategoriBarangController extends Controller
{
    public function __construct(KategoribarangService $kategoribarangservice){
        $this->kategoribarangservice = $kategoribarangservice;
    }
    public function index()
    {
        $kategoris = Kategoribarang::all();
        $title = 'Hapus Data Kategori Barang';
        $text = "Apakah anda yakin ingin menghapus data ini?";
        confirmDelete($title, $text);
        return view('admin.kategoribarang.index', compact('kategoris'));
    }

    public function create()
    {
        return view('admin.kategoribarang.create');
    }

    public function store(Storekategoribarang $request)
    {
        $data = $this->kategoribarangservice->createKategoribarang($request->all());
        toast('Kategori Barang berhasil ditambahkan','success');
        return redirect()->route('kategori_barang.index')->with('success', 'Kategori Barang created successfully.');
    }

    public function show($id)
    {
        $kategori = Kategoribarang::find($id);

        if (!$kategori) {
            return redirect()->route('kategori_barang.index')->with('error', 'Kategori Barang not found.');
        }

        return view('admin.kategoribarang.show', compact('kategori'));
    }

    public function edit($id)
    {
        $kategori = Kategoribarang::find($id);

        if (!$kategori) {
            return redirect()->route('kategori_barang.index')->with('error', 'Kategori Barang not found.');
        }

        return view('admin.kategoribarang.edit', compact('kategori'));
    }

    public function update(Updatekategoribarang $request, $id)
    {
        $kategori = Kategoribarang::find($id);

        if (!$kategori) {
            return redirect()->route('kategori_barang.index')->with('error', 'Kategori Barang not found.');
        }
        $this->kategoribarangservice->updateKategoribarang($request->all(), $kategori);
        toast('Kategori Barang berhasil diubah','success');
        return redirect()->route('kategori_barang.index')->with('success', 'Kategori Barang updated successfully.');
    }

    public function destroy($id)
    {
        $kategori = Kategoribarang::find($id);
        toast('Kategori Barang berhasil dihapus','success');
        if (!$kategori) {
            return redirect()->route('kategori_barang.index')->with('error', 'Kategori Barang not found.');
        }

        $kategori->delete();

        return redirect()->route('kategori_barang.index')->with('success', 'Kategori Barang deleted successfully.');
    }
}
