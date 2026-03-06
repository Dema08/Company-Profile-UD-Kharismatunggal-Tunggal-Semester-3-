<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PengaturanService;
use App\Services\HeroImageService;
use App\Http\Requests\StorePengaturanRequest;
use App\Http\Requests\UpdatePengaturanRequest;


class PengaturanController extends Controller
{
    protected $pengaturanService,$heroimageservice;

    public function __construct(PengaturanService $pengaturanService, HeroImageService $heroimageservice)
    {
        $this->pengaturanService = $pengaturanService;
        $this->heroimageservice = $heroimageservice;

    }

    public function index()
    {
        $heroimages = $this->heroimageservice->getAllHeroImages();
        $settings = $this->pengaturanService->getSettingById(1)->first();
        $title = 'Hapus Data Image';
        $text = "Apakah anda yakin ingin menghapus data ini?";
        confirmDelete($title, $text);
        return view('admin.pengaturan.pengaturan',compact('settings','heroimages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePengaturanRequest  $request)
    {
        $data = $request->only(['nama_toko', 'alamat_toko', 'no_hp_toko', 'koordinat_toko', 'logo_toko', 'linkshopee_toko']);
        $setting = $this->pengaturanService->createSetting($data);
        toast('Data pengaturan Aplikasi berhasil ditambahkan','success');
        return redirect()->route('pengaturan.index')->with('success', 'Data pengaturan berhasil ditambahkan.');
    }

    public function storeHeroImage(Request $request){
        $validate = $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg',
        ]);

        $this->heroimageservice->createHeroImage($request);
        toast('Data image berhasil ditambahkan','success');
        return redirect()->route('pengaturan.index')->with('success', 'Data hero image berhasil ditambahkan.');
    }

    public function updateHeroImage(Request $request, $id){
        $validate = $request->validate([
            'image' => 'image|mimes:jpeg,png,jpg',
        ]);

        $this->heroimageservice->updateHeroImage($request, $id);
        toast('Data image berhasil diperbarui','success');
        return redirect()->route('pengaturan.index')->with('success', 'Data hero image berhasil ditambahkan.');
    }

    public function deleteHeroImage($id){
        $this->heroimageservice->deleteHeroImage($id);
        toast('Data image berhasil ditambahkan','success');
        return redirect()->route('pengaturan.index')->with('success', 'Data hero image berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pengaturan  $pengaturan
     * @return \Illuminate\Http\Response
     */
    public function show(Pengaturan $pengaturan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pengaturan  $pengaturan
     * @return \Illuminate\Http\Response
     */
    public function edit(Pengaturan $pengaturan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pengaturan  $pengaturan
     * @return \Illuminate\Http\Response
     */
    public function update(Request  $request, $id)
    {
        $setting = $this->pengaturanService->updateSetting($id, $request);
        toast('Data pengaturan Aplikasi berhasil diperbarui','success');
        return redirect()->route('pengaturan.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pengaturan  $pengaturan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pengaturan $pengaturan)
    {
        //
    }
}
