<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\DatapenggunaService;
use App\Http\Requests\pengguna\Storedatapengguna;
use App\Http\Requests\pengguna\Updatedatapengguna;

class DatapenggunaControllerapi extends Controller
{
    private $datapenggunaservice;

    public function __construct(DatapenggunaService $datapenggunaservice)
    {
        $this->datapenggunaservice = $datapenggunaservice;
    }

    public function index(){
        $users = $this->datapenggunaservice->getAllUsers();
        return response()->json(["data" => $users], 200);
    }
    public function getuserbyid(Request $request){
        if(!isset($request->id_pengguna)){
            return response()->json(["message" => "parameter salah"], 404);
        }
        $user = $this->datapenggunaservice->finduserbyid($request->id_pengguna);
        return response()->json(["data" => $user], 200);
    }
    public function getuserbyname(Request $request){
        if(!isset($request->nama_pengguna)){
            return response()->json(["message" => "parameter salah"], 404);
        }
        $user = $this->datapenggunaservice->finduserbyname($request->nama_pengguna);
        return response()->json(["data" => $user], 200);
    }
    public function getuserbyemail(Request $request){
        if(!isset($request->email)){
            return response()->json(["message" => "parameter salah"], 404);
        }
        $user = $this->datapenggunaservice->findUserByEmail($request->email);
        return response()->json(["data" => $user], 200);
    }
    public function store(Storedatapengguna $request){
        $data = $this->datapenggunaservice->createUser($request);
        return response()->json(["data" => $data,"message" => "Data pengguna berhasil ditambahkan."], 200);
    }
    public function update(Updatedatapengguna $request, $id_pengguna){
        $data = $this->datapenggunaservice->updateUser($id_pengguna, $request);
        return response()->json(["data" => $data,"message" => "Data pengguna berhasil diupdate."], 200);
    }
    public function destroy($id_pengguna){
        $data = $this->datapenggunaservice->deleteUser($id_pengguna);
        if($data == false){
            return response()->json(["message" => "Data pengguna tidak ditemukan."], 404);
        }
        return response()->json(["message" => "Data pengguna berhasil dihapus."], 200);
    }
}
