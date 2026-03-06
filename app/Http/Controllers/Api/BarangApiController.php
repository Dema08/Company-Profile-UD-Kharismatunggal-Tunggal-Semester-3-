<?php

namespace App\Http\Controllers\Api;

use App\Services\BarangService;
use App\Models\Barang;
use App\Http\Requests\StoreBarang;
use App\Http\Requests\UpdateBarang;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\PengaturanService;

class BarangApiController extends Controller
{
    protected $barangService, $pengaturanservice;

    public function __construct(BarangService $barangService, PengaturanService $pengaturanservice)
    {
        $this->barangService = $barangService;
        $this->pengaturanservice = $pengaturanservice;
    }

    public function index()
    {
        $barangs = $this->barangService->getAllBarangs()->where('is_visible', '1')->get();
        $barangsWithRatings = $barangs->map(function ($barang) {
            return array_merge($barang->toArray(), [
                'average_rating' => $barang->averageRating() ?? 0,
            ]);
        });
        $pengaturan = $this->pengaturanservice->getAllSettings();
        return response()->json(['data' => $barangsWithRatings, 'pengaturan' => $pengaturan]);
    }

    public function getbarangbykategori(Request $request)
    {
        $barangs = $this->barangService->searchbarang($request)->where('is_visible', '1')->get();
        $pengaturan = $this->pengaturanservice->getAllSettings();
        if (empty($barangs)) {
            return response()->json(['data' => $barangs, 'pengaturan' => $pengaturan]);
        } else {
            return response()->json(['data' => $barangs, 'pengaturan' => $pengaturan]);
        }
    }

    public function store(StoreBarang $request)
    {
        $data = $request->validated();
        $barang = $this->barangService->createBarang($data);
        return response()->json(['message' => 'Barang created successfully', 'data' => $barang], 201);
    }

    public function show($id)
    {
        // Mengambil pengaturan
        $pengaturan = $this->pengaturanservice->getAllSettings();

        // Mengambil data barang berdasarkan ID dan filter berdasarkan visibilitas
        $barangs = $this->barangService->getAllBarangs()->where('id_barang', $id)->where('is_visible', '1')->get();

        // Mengambil ulasan yang disetujui untuk semua barang
        $barangsWithRatings = $barangs->map(function ($barang) {
            // Mengambil ulasan yang diterima
            $approvedReviews = $barang->ulasan->where('status', 'terima');

            // Menghitung jumlah rating untuk setiap nilai
            $ratings = [
                5 => $approvedReviews->where('jumlah_rating', 5)->count() ?? 0,
                4 => $approvedReviews->where('jumlah_rating', 4)->count() ?? 0,
                3 => $approvedReviews->where('jumlah_rating', 3)->count() ?? 0,
                2 => $approvedReviews->where('jumlah_rating', 2)->count() ?? 0,
                1 => $approvedReviews->where('jumlah_rating', 1)->count() ?? 0,
            ];

            // Menghitung average rating dari ulasan
            $averageRating = $approvedReviews->avg('jumlah_rating') ?? 0;

            return array_merge($barang->toArray(), [
                'average_rating' => $averageRating,
                'ratings' => $ratings, // Menambahkan data jumlah rating
            ]);
        });

        // Menggabungkan pengaturan dan data barang dengan rating
        return response()->json([
            'data' => $barangsWithRatings,
            'pengaturan' => $pengaturan,
        ]);
    }

    public function update(UpdateBarang $request, $id)
    {
        $barang = Barang::findOrFail($id);
        $data = $request->validated();
        $barang = $this->barangService->updateBarang($data, $barang);
        return response()->json(['message' => 'Barang updated successfully', 'data' => $barang]);
    }

    public function destroy($id)
    {
        $barang = Barang::findOrFail($id);
        $this->barangService->deleteBarang($barang);
        return response()->json(['message' => 'Barang deleted successfully']);
    }
}
