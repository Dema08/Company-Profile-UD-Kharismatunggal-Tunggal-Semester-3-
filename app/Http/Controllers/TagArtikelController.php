<?php

namespace App\Http\Controllers;

use App\Models\TagArtikel;
use App\Services\TagArtikelService;
use App\Http\Requests\StoreTagArtikel;
use App\Http\Requests\UpdateTagArtikel;

class TagArtikelController extends Controller
{
    protected $tagArtikelService;

    public function __construct(TagArtikelService $tagArtikelService)
    {
        $this->tagArtikelService = $tagArtikelService;
    }

    public function index()
    {
        $tags = $this->tagArtikelService->getAllTags()->get();
        $title = 'Hapus Data Tag Artikel';
        $text = "Apakah anda yakin ingin menghapus data ini?";
        confirmDelete($title, $text);
        return view('admin.tag.index', compact('tags'));
    }

    public function create()
    {
        return view('admin.tag.create');
    }

    public function store(StoreTagArtikel $request)
    {
        $validatedData = $request->validated();
        $this->tagArtikelService->createTag($validatedData);
        toast('Tag Artikel berhasil ditambahkan','success');
        return redirect()->route('tags.index')->with('success', 'Tag berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $tag = TagArtikel::findOrFail($id);
        return view('admin.tag.edit', compact('tag'));
    }

    public function update(UpdateTagArtikel $request, $id)
    {
        $validatedData = $request->validated();

        $this->tagArtikelService->updateTag($id, $validatedData);
        toast('Tag Artikel berhasil diperbarui','success');
        return redirect()->route('tags.index')->with('success', 'Tag berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $this->tagArtikelService->deleteTag($id);
        toast('Tag Artikel berhasil dihapus','success');
        return redirect()->route('tags.index')->with('success', 'Tag berhasil dihapus.');
    }
}
