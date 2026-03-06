<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detailkategoribarang extends Model
{
    use HasFactory;

    protected $table = 'tb_detail_kategori_barang';
    protected $primaryKey = 'id_detail_kategori_barang';
    protected $fillable = ['id_kategori_barang', 'id_barang'];

    public function kategoriBarang()
    {
        return $this->belongsTo(Kategoribarang::class, 'id_kategori_barang', 'id_kategori_barang');
    }
    public function Barang(){
        return $this->hasMany(Barang::class, 'id_barang');
    }
}
