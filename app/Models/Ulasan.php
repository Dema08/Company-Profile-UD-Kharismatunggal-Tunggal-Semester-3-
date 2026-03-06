<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ulasan extends Model
{
    use HasFactory;

    protected $table = 'tb_barang_ulasan';
    protected $primaryKey = 'id_ulasan';
    protected $fillable = [
        'id_datapengguna',
        'nama_pengguna',
        'id_barang',
        'jumlah_rating',
        'text',
        'status',
    ];

    // Relasi dengan model Datapengguna
    public function pengguna()
    {
        return $this->belongsTo(datapengguna::class, 'id_datapengguna');
    }

    // Relasi dengan model Barang
    public function barang()
    {
        return $this->belongsTo(Barang::class, 'id_barang');
    }
}
