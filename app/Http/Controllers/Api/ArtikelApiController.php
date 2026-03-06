<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\ArtikelService;
use App\Http\Requests\StoreArtikel;
use App\Http\Requests\UpdateArtikel;
use Illuminate\Support\Facades\Storage;

class ArtikelApiController extends Controller
{
    protected $artikelService;

    public function __construct(ArtikelService $artikelService)
    {
        $this->artikelService = $artikelService;
    }

    public function index()
    {
        $artikels = $this->artikelService->getAllArticles()->get();
        return response()->json(['data' => $artikels]);
    }

    public function store(StoreArtikel $request)
    {
        $data = $request->validated();
        $tags = $request->input('tags', []);

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('artikel_images', 'public');
        }

        $artikel = $this->artikelService->createArticle($data, $tags);
        return response()->json($artikel, 201);
    }

    public function show($id)
    {
        $artikel = $this->artikelService->findArticleById($id);
        return response()->json(['data' => $artikel]);
    }

    public function update(UpdateArtikel $request, $id)
    {
        $data = $request->validated();
        $tags = $request->input('tags', []);

        if ($request->hasFile('gambar')) {
            $existingArtikel = $this->artikelService->findArticleById($id);
            if ($existingArtikel->gambar) {
                Storage::disk('public')->delete($existingArtikel->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('artikel_images', 'public');
        }

        $artikel = $this->artikelService->updateArticle($id, $data, $tags);
        return response()->json($artikel);
    }

    public function destroy($id)
    {
        $this->artikelService->deleteArticle($id);
        return response()->json(['message' => 'Artikel deleted successfully']);
    }
}
