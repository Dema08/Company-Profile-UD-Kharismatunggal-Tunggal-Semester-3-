<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategoribarang extends Model
{
    use HasFactory;

    protected $table = 'tb_kategori_barang'; 
    protected $primaryKey = 'id_kategori_barang';
    public $incrementing = true;
    protected $keyType = 'int';
    protected $fillable = ['nama'];

    public function barangs()
    {
        return $this->hasMany(Barang::class, 'id_kategori_barang', 'id_kategori_barang');
    }
    public function detailkategoribarang()
    {
        return $this->hasMany(detailkategoribarang::class, 'id_kategori_barang', 'id_kategori_barang');
    }
}
