<?php

namespace App\Services;

use App\Models\Artikel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArtikelService
{
    public function getAllArticles()
    {
        return Artikel::with('tags');
    }

    public function findArticleById($id_artikel)
    {
        return Artikel::with('tags')->findOrFail($id_artikel);
    }

    public function searchartikel($data){
        $tag = $data->tag ?? null;
        $urutkan = ($data->urutkan == 'asc' ? 'asc' : 'desc');
        $search = $data->search ?? null;
        $query = $this->getAllArticles();

        //find berdasarkan tag
        if($tag != null){
            $query->whereHas('tags', function ($query) use ($tag) {
                $query->where('tb_tag_artikel.id_tag_artikel', $tag);
            });
        }
        $query->orderBy('judul', $urutkan);

        if($search != null){
            $query->where('judul', 'like', '%'.$search.'%')
                ->orWhere('isi', 'like', '%'.$search.'%');
        }
        return $query;

    }

    public function createArticle(Request $request)
    {

        $artikel = Artikel::create([
            'id_datapengguna' => $request->id_datapengguna,
            'judul' => $request->judul,
            'deskripsi_singkat' => $request->deskripsi_singkat,
            'isi' => $request->isi
        ]);

        if ($request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('artikel_images', 'public');
            $artikel->update(['gambar' => $path]);
        }

        if ($request->has('tags')) {
            $artikel->tags()->attach($request->input('tags'));
        }

        return $artikel;
    }

    public function updateArticle($id_artikel, Request $request)
    {
        $artikel = Artikel::findOrFail($id_artikel);
        $artikel->update([
            'id_datapengguna' => $request->id_datapengguna,
            'judul' => $request->judul,
            'deskripsi_singkat' => $request->deskripsi_singkat,
            'isi' => $request->isi,
        ]);

        if ($request->hasFile('gambar')) {
            if ($artikel->gambar) {
                Storage::disk('public')->delete($artikel->gambar);
            }
            $path = $request->file('gambar')->store('artikel_images', 'public');
            $artikel->update(['gambar' => $path]);
        }

        if ($request->has('tags')) {
            $artikel->tags()->sync($request->input('tags'));
        }

        return $artikel;
    }

    public function deleteArticle($id_artikel)
    {
        $artikel = Artikel::findOrFail($id_artikel);

        if ($artikel->gambar) {
            Storage::disk('public')->delete($artikel->gambar);
        }
        $artikel->tags()->detach();

        $artikel->delete();

        return $artikel;
    }
}
