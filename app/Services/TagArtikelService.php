<?php

namespace App\Services;

use App\Models\TagArtikel;
use Illuminate\Support\Facades\DB;

class TagArtikelService
{
    public function getAllTags()
    {
        return TagArtikel::withCount('artikels');
    }

    public function createTag(array $data)
    {
        DB::transaction(function () use ($data) {
            TagArtikel::create([
                'nama_tag' => $data['nama_tag'],
            ]);
        });
    }

    public function updateTag($id, array $data)
    {
        DB::transaction(function () use ($id, $data) {
            $tag = TagArtikel::findOrFail($id);
            $tag->update([
                'nama_tag' => $data['nama_tag'],
            ]);
        });
    }

    public function deleteTag($id)
    {
        $tag = TagArtikel::find($id);
        $tag->delete();
        return true;
    }
}
