<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\PengaturanService;

class PengaturanApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $pengaturanservice;

    public function __construct(PengaturanService $pengaturanservice)
    {
        $this->pengaturanservice = $pengaturanservice;
    }

    public function index()
    {
        $pengaturan = $this->pengaturanservice->getAllSettings();
        return response()->json(['pengaturan' => $pengaturan]);
    }
}
