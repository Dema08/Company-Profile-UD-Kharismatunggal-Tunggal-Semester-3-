<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
class datapengguna extends Authenticatable
{
    use HasFactory, Notifiable,HasApiTokens;

    protected $table = 'tb_datapengguna';
    protected $primaryKey = 'id_datapengguna';

    protected $fillable = [
        'id_datapengguna',
        'nama_pengguna',
        'email',
        'password',
        'alamat',
        'no_telp',
        'role',
    ];

    // Untuk menyembunyikan atribut sensitif seperti password
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Jika Anda menggunakan timestamps di database
    public $timestamps = true;

    // Jika Anda ingin menggunakan casting untuk beberapa atribut
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Untuk mengatur nama atribut yang digunakan untuk autentikasi
    public function getAuthPassword()
    {
        return $this->password;
    }
}
