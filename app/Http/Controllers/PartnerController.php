<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePartnerRequest;
use App\Http\Requests\UpdatePartnerRequest;
use App\Services\PartnerService;
use App\Models\Partner;

class PartnerController extends Controller
{
    private $partnerservice;

    public function __construct(PartnerService $partnerservice)
    {
        $this->partnerservice = $partnerservice;
    }

    public function index()
    {
        $title = 'Hapus Data Partner';
        $text = "Apakah anda yakin ingin menghapus data ini?";
        confirmDelete($title, $text);
        $partners = $this->partnerservice->getAllPartners();
        return view('admin.partners.index', compact('partners'));
    }

    public function create()
    {
        return view('admin.partners.create');
    }

    public function store(StorePartnerRequest $request)
    {
        $data = $request->validated();
        $data['is_visible'] = $request->input('is_visible');  // Menambahkan is_visible


        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar');
        }

        $this->partnerservice->storePartner($data);
        toast('Partner berhasil ditambahkan','success');
        return redirect()->route('partners.index')->with('success', 'Partner berhasil ditambahkan.');
    }

    public function edit(Partner $partner)
    {
        return view('admin.partners.edit', compact('partner'));
    }

    public function update(UpdatePartnerRequest $request, Partner $partner)
{
    $data = $request->validated();
    $data['is_visible'] = $request->input('is_visible');

    if ($request->hasFile('gambar')) {
        $data['gambar'] = $request->file('gambar');
    }

    $this->partnerservice->updatePartner($data, $partner);
    toast('Partner berhasil diperbarui','success');
    return redirect()->route('partners.index')->with('success', 'Partner berhasil diperbarui.');
}


    public function destroy(Partner $partner)
    {
        $this->partnerservice->deletePartner($partner);
        toast('Partner berhasil dihapus','success');
        return redirect()->route('partners.index')->with('success', 'Partner berhasil dihapus.');
    }
}
