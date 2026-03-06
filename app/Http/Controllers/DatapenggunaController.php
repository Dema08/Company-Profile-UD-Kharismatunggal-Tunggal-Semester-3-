<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\DatapenggunaService;
use App\Http\Requests\pengguna\Storedatapengguna;
use App\Http\Requests\pengguna\Updatedatapengguna;

class DatapenggunaController extends Controller
{

    private $datapenggunaservice;

    public function __construct(DatapenggunaService $datapenggunaservice)
    {
        $this->datapenggunaservice = $datapenggunaservice;
    }

    public function index()
    {
        $users = $this->datapenggunaservice->getAllUsers();
        $title = 'Hapus Data Pengguna';
        $text = "Apakah anda yakin ingin menghapus data ini?";
        confirmDelete($title, $text);
        return view('admin.pengguna.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pengguna.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Pengguna\StoreDatapengguna  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Storedatapengguna $request)
    {
        $data = $this->datapenggunaservice->createUser($request);
        toast('Data pengguna berhasil ditambahkan','success');
        return redirect()->route('pengguna.index')->with('success', 'Data pengguna berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id_pengguna
     * @return \Illuminate\Http\Response
     */
    public function edit($id_pengguna)
    {
        $datapengguna = $this->datapenggunaservice->findUserById($id_pengguna);

        if (!$datapengguna) {
            return redirect()->route('pengguna.index')->with('error', 'Data pengguna tidak ditemukan.');
        }

        return view('admin.pengguna.edit', compact('datapengguna'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Pengguna\UpdateDatapengguna  $request
     * @param  int  $id_pengguna
     * @return \Illuminate\Http\Response
     */
    public function update(Updatedatapengguna $request, $id_pengguna)
    {
        $data = $this->datapenggunaservice->updateUser($id_pengguna, $request);
        toast('Data pengguna berhasil diubah','success');
        if (!$data) {
            return redirect()->route('pengguna.index')->with('error', 'Data pengguna tidak ditemukan.');
        }

        return redirect()->route('pengguna.index')->with('success', 'Data pengguna berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id_pengguna
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_pengguna)
    {
        $data = $this->datapenggunaservice->deleteUser($id_pengguna);
        toast('Data pengguna berhasil dihapus','success');
        if (!$data) {
            return redirect()->route('pengguna.index')->with('error', 'Data pengguna tidak ditemukan.');
        }

        return redirect()->route('pengguna.index')->with('success', 'Data pengguna berhasil dihapus.');
    }
}
