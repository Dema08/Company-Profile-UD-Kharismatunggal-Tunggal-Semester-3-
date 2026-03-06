<?php

namespace App\Http\Controllers;

use App\Models\Ulasan;
use Illuminate\Http\Request;
use App\Services\UlasanService;
use Crypt;
use Auth;
use RealRashid\SweetAlert\Facades\Alert;

class UlasanController extends Controller
{
    protected $ulasanservice;

    public function __construct(UlasanService $ulasanservice)
    {
        $this->ulasanservice = $ulasanservice;
    }

    public function index()
    {
        $title = 'Hapus Data Ulasan';
        $text = "Apakah anda yakin ingin menghapus data ini?";
        confirmDelete($title, $text);
        $ulasan = $this->ulasanservice->getallulasan()->get();
        return view('admin.ulasan.index', compact('ulasan'));
    }

    public function store(Request $request, $id)
    {
        $id = Crypt::decrypt($id);

        // Cek pembatasan waktu komentar (1 menit)
        $userId = Auth::check() ? Auth::user()->id_datapengguna : $request->ip(); // Gunakan IP jika user tidak login
        $lastCommentTime = session("last_comment_time_{$id}_{$userId}", null);

        if ($lastCommentTime && now()->diffInSeconds($lastCommentTime) < 120) {
            return redirect()->route('users.barangdetail', Crypt::encrypt($id))
                ->with('error', 'Anda hanya bisa memberikan komentar sekali setiap 2 menit.');
        }

        // Validasi input
        $request->validate([
            'nama_pengguna' => 'required_if:auth,false',
            'jumlah_rating' => 'required|integer|min:1|max:5',
            'komentar' => 'required|string|max:500',
        ]);

        // Simpan komentar
        $ulasan = Ulasan::create([
            'id_barang' => $id,
            'id_datapengguna' => Auth::check() ? Auth::user()->id_datapengguna : null,
            'nama_pengguna' => Auth::check() ? null : $request->nama_pengguna,
            'text' => $request->komentar,
            'jumlah_rating' => $request->jumlah_rating
        ]);

        // Simpan waktu komentar terakhir ke session
        session(["last_comment_time_{$id}_{$userId}" => now()]);
        alert()->success('Berhasil','Berhasil Menambahkan Ulasan');
        return redirect()->route('users.barangdetail', Crypt::encrypt($id))
            ->with('success', 'Ulasan berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $ulasan = Ulasan::findOrFail($id);
        $ulasan->update($request->all());
        toast('Ulasan berhasil diperbarui','success');
        return redirect()->route('ulasan.index')->with('success', 'Ulasan berhasil diperbarui');
    }

    public function updateStatus(Request $request, $id)
    {
        $ulasan = Ulasan::findOrFail($id);

        $ulasan->update([
            'status' => $request->status
        ]);
        toast('Ulasan berhasil diperbarui','success');
        return redirect()->route('ulasan.index')->with('success', 'Ulasan berhasil diperbarui');
    }

    public function ulasanpage($id)
    {
        $ulasan = Ulasan::findOrFail($id);
        return view('admin.ulasan.approveulasan', compact('ulasan'));
    }

    public function destroy($id)
    {
        $ulasan = Ulasan::findOrFail($id);
        $ulasan->delete();
        toast('Ulasan berhasil dihapus','success');
        return redirect()->route('ulasan.index')->with('success', 'Ulasan berhasil dihapus');
    }
}
