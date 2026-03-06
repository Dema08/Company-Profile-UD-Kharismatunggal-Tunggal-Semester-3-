<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\UlasanService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UlasanApiController extends Controller
{
    protected $ulasanService;

    public function __construct(UlasanService $ulasanService)
    {
        $this->ulasanService = $ulasanService;
    }

    public function index()
    {
        $ulasan = $this->ulasanService->all();
        return response()->json($ulasan);
    }

    public function show($id)
    {
        $ulasan = $this->ulasanService->find($id);
        if ($ulasan) {
            return response()->json($ulasan);
        }
        return response()->json(['message' => 'Ulasan tidak ditemukan'], Response::HTTP_NOT_FOUND);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'id_datapengguna' => 'required|exists:tb_datapengguna,id_datapengguna',
            'id_barang' => 'required|exists:tb_data_barang,id_barang',
            'text' => 'required|string',
        ]);

        $ulasan = $this->ulasanService->create($validatedData);
        return response()->json($ulasan, Response::HTTP_CREATED);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'id_datapengguna' => 'required|exists:tb_datapengguna,id_datapengguna',
            'id_barang' => 'required|exists:tb_data_barang,id_barang',
            'text' => 'required|string',
        ]);

        $ulasan = $this->ulasanService->update($id, $validatedData);
        if ($ulasan) {
            return response()->json($ulasan);
        }
        return response()->json(['message' => 'Ulasan tidak ditemukan'], Response::HTTP_NOT_FOUND);
    }

    public function destroy($id)
    {
        if ($this->ulasanService->delete($id)) {
            return response()->json(['message' => 'Ulasan berhasil dihapus']);
        }
        return response()->json(['message' => 'Ulasan tidak ditemukan'], Response::HTTP_NOT_FOUND);
    }
}
