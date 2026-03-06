<?php

namespace App\Http\Controllers;

use App\Services\ArtikelService;
use App\Services\TagArtikelService;
use App\Http\Requests\StoreArtikel;
use App\Http\Requests\UpdateArtikel;
use Illuminate\Http\Request;

class ArtikelController extends Controller
{
    protected $artikelService;
    protected $tagArtikelService;

    public function __construct(ArtikelService $artikelService, TagArtikelService $tagArtikelService)
    {
        $this->artikelService = $artikelService;
        $this->tagArtikelService = $tagArtikelService;
    }

    public function index()
    {
        $artikels = $this->artikelService->getAllArticles()->get();
        $title = 'Hapus Data Artikel';
        $text = "Apakah anda yakin ingin menghapus data ini?";
        confirmDelete($title, $text);
        return view('admin.artikel.index', compact('artikels'));
    }

    public function create()
    {
        $tags = $this->tagArtikelService->getAllTags()->get();
        return view('admin.artikel.create', compact('tags'));
    }

    public function store(StoreArtikel $request)
    {
        $this->artikelService->createArticle($request);
        toast('Artikel berhasil ditambahkan','success');
        return redirect()->route('artikel.index')->with('success', 'Artikel berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $artikel = $this->artikelService->findArticleById($id);
        $tags = $this->tagArtikelService->getAllTags()->get();
        return view('admin.artikel.edit', compact('artikel', 'tags'));
    }

    public function update(UpdateArtikel $request, $id)
    {
        $this->artikelService->updateArticle($id, $request);
        toast('Artikel berhasil diperbarui','success');
        return redirect()->route('artikel.index')->with('success', 'Artikel berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $this->artikelService->deleteArticle($id);
        toast('Artikel berhasil dihapus','success');
        return redirect()->route('artikel.index')->with('success', 'Artikel berhasil dihapus.');
    }
}
