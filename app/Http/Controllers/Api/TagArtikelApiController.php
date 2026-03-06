<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\TagArtikelService;
use Illuminate\Http\Request;

class TagArtikelApiController extends Controller
{
    protected $tagArtikelService;

    public function __construct(TagArtikelService $tagArtikelService)
    {
        $this->tagArtikelService = $tagArtikelService;
    }

    public function index()
    {
        $tags = $this->tagArtikelService->getAllTags()->get();
        return response()->json(['data' => $tags]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_tag' => 'required|string|max:100',
        ]);

        $tag = $this->tagArtikelService->createTag($request);
        return response()->json(['message' => 'Tag created successfully', 'data' => $tag], 201);
    }

    public function show($id)
    {
        $tag = $this->tagArtikelService->findTagById($id);
        return response()->json(['data' => $tag]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_tag' => 'required|string|max:100',
        ]);

        $tag = $this->tagArtikelService->updateTag($id, $request);
        return response()->json(['message' => 'Tag updated successfully', 'data' => $tag]);
    }

    public function destroy($id)
    {
        $this->tagArtikelService->deleteTag($id);
        return response()->json(['message' => 'Tag deleted successfully']);
    }
}
