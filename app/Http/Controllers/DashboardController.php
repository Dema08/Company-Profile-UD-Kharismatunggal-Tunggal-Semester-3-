<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\BarangService;
use App\Services\ArtikelService;
use App\Services\UlasanService;
use App\Services\DatapenggunaService;
class DashboardController extends Controller
{
    protected $artikelService;
    protected $ulasanservice;
    protected $barangService;
    protected $datapenggunaservice;

    public function __construct(BarangService $barangService,ArtikelService $artikelService,UlasanService $ulasanservice,DatapenggunaService $datapenggunaservice)
    {
        $this->artikelService = $artikelService;
        $this->barangService = $barangService;
        $this->ulasanservice = $ulasanservice;
        $this->datapenggunaservice = $datapenggunaservice;
    }

    public function index(){
        $barangcount = $this->barangService->getAllBarangs()->count();
        $artikelcount = $this->artikelService->getAllArticles()->count();
        $ulasancount = $this->ulasanservice->getallulasan()->count();
        $datapenggunacount = $this->datapenggunaservice->getAllUsers()->count();
        return view('admin.dashboard.index',compact('barangcount','artikelcount','ulasancount','datapenggunacount'));
    }
}
