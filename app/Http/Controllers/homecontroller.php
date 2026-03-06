<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\BarangService;
use App\Services\KategoribarangService;
use App\Services\UlasanService;
use App\Services\ArtikelService;
use App\Services\TagArtikelService;
use App\Services\PartnerService;
use App\Services\FAQService;
use App\Services\HeroImageService;
use Crypt;

class homecontroller extends Controller
{
    protected $barangService,$ulasanservice,$ArtikelService,$partnerservice,$faqservice,$heroimageservice;

    public function __construct(BarangService $barangService,UlasanService $ulasanservice,ArtikelService $artikelservice,TagArtikelService $tagartikelservice,KategoribarangService $kategoribarangservice,PartnerService $partnerservice,FAQService $faqservice,HeroImageService $heroimageservice)
    {
        $this->barangService = $barangService;
        $this->ulasanservice = $ulasanservice;
        $this->artikelservice = $artikelservice;
        $this->tagartikelservice = $tagartikelservice;
        $this->kategoribarangservice = $kategoribarangservice;
        $this->partnerservice = $partnerservice;
        $this->faqservice = $faqservice;
        $this->heroimageservice = $heroimageservice;
    }
    public function index(){
        $heroimages = $this->heroimageservice->getAllHeroImages();
        $barangs = $this->barangService->getAllBarangs()->where('is_visible', '1')->limit(6)->get();
        $ulasans = $this->ulasanservice->getallulasan()->where('status','terima')->limit(9)->get();
        return view('users.index',compact('barangs','ulasans','heroimages'));
    }
    public function about(){
        $heroimages = $this->heroimageservice->getAllHeroImages()->where('tampilkandiabout', 1);
        $partners = $this->partnerservice->getAllPartners()->where('is_visible', '1');
        return view('users.about',compact('partners','heroimages'));
    }
    public function artikel(){
        $artikels = $this->artikelservice->getAllArticles()->get();
        $tagartikel = $this->tagartikelservice->getAllTags()->get();
        return view('users.artikel',compact('artikels','tagartikel'));
    }
    public function searchartikel(Request $request){
        $artikels = null;
        if($request->search == null && $request->tag == null && $request->urutkan == null){
            $artikels = $this->artikelservice->getAllArticles()->get();
        }else{
            $artikels = $this->artikelservice->searchartikel($request)->get();
        }
        $tagartikel = $this->tagartikelservice->getAllTags()->get();
        return view('users.artikel',compact('artikels','tagartikel'));
    }
    public function searchbarang(Request $request){
        $barangs = null;
        if($request->search == null && $request->kategori == null && $request->urutkan == null){
            $barangs = $this->barangService->getAllBarangs()->where('is_visible', '1')->get();
        }else{
            $barangs = $this->barangService->searchbarang($request)->get();
        }
        $kategoris = $this->kategoribarangservice->getAllKategoribarangs();
        return view('users.barang',compact('barangs','kategoris'));
    }
    public function barang(){
        $barangs = $this->barangService->getAllBarangs()->where('is_visible', '1')->get();
        $kategoris = $this->kategoribarangservice->getAllKategoribarangs();
        return view('users.barang',compact('barangs','kategoris'));
    }
    public function barang_detail($id){
        $id = Crypt::decrypt($id);
        $baranglainya = $this->barangService->getAllBarangs()->where('id_barang', '!=', $id)->where('is_visible', '1')->limit(9)->get();
        $barang = $this->barangService->getAllBarangs()->where('id_barang', $id)->first();
        return view('users.detailbarang',compact('barang','baranglainya'));
    }
    public function artikel_detail($id){
        $id = Crypt::decrypt($id);
        $artikel = $this->artikelservice->getAllArticles()->where('id_artikel', $id)->first();
        $latestposts = $this->artikelservice->getAllArticles()->orderBy('created_at', 'desc')->limit(3)->whereNot('id_artikel', $id)->get();
        $tagartikels = $this->tagartikelservice->getAllTags()->get();
        return view('users.detailartikel',compact('artikel','latestposts','tagartikels'));
    }
    public function faq(){
        $faqs = $this->faqservice->getAllFAQs();
        // dd($faqs);
        return view('users.faq',compact('faqs'));
    }
    public function searchfaq(Request $request){
        $faqs = $this->faqservice->searchpertanyaan($request);
        return view('users.faq',compact('faqs'));
    }
}
