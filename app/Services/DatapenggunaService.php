<?php

namespace App\Services;

use App\Models\datapengguna;
use Illuminate\Support\Facades\Hash;

class DatapenggunaService
{
    public function getAllUsers()
    {
        return datapengguna::all();
    }

    public function findUserById($id)
    {
        return datapengguna::find($id);
    }
    public function finduserbyname($nama_pengguna)
    {
        return datapengguna::where('nama_pengguna', 'like', '%' . $nama_pengguna . '%')->get();
    }

    public function findUserByEmail($email)
    {
        return datapengguna::where('email', $email)->first();
    }

    public function createUser($request)
    {
        // Validasi data
        $validatedData = $request->only(['nama_pengguna', 'email', 'password', 'alamat', 'no_telp','role']);

        $validatedData['password'] = Hash::make($validatedData['password']);
        $validatedData['role'] = ($request->role == 'admin')?'admin':'user'; // Atur role sesuai kebutuhan

        // Membuat pengguna baru
        return datapengguna::create($validatedData);
    }

    public function updateUser($id, $request)
    {
        $user = datapengguna::find($id);

        if ($user) {
            // Ambil data yang divalidasi
            $validatedData = $request->only(['nama_pengguna', 'email', 'password', 'alamat', 'no_telp','role']);

            // Jika password tidak kosong, hash password baru
            if (!empty($validatedData['password'])) {
                $validatedData['password'] = Hash::make($validatedData['password']);
            } else {
                // Jika password tidak diisi, hapus dari array data
                unset($validatedData['password']);
            }

            $user->update($validatedData);

            return $user;
        }

        return false;
    }

    public function deleteUser($id)
    {
        $user = datapengguna::find($id);

        if ($user) {
            $user->delete();
            return $user;
        }

        return false;
    }
}
