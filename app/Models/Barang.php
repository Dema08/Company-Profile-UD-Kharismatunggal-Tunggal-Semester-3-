<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Barang extends Model
{
    use HasFactory;

    // Menghubungkan model dengan tabel 'tb_data_barang'
    protected $table = 'tb_data_barang';
    protected $primaryKey = 'id_barang';
    public $incrementing = true;

    // Kolom-kolom yang dapat diisi secara massal
    protected $fillable = [
        'nama_barang',
        'deskripsi_singkat',
        'deskripsi',
        'harga_barang',
        'link_shopee',
        'is_visible',
    ];

    // Relasi ke tabel GalleryBarang
    public function gallery()
    {
        return $this->hasMany(GalleryBarang::class, 'id_barang', 'id_barang');
    }

    // Relasi ke detail kategori barang
    public function kategori()
    {
        return $this->hasMany(detailkategoribarang::class, 'id_barang');
    }

    // Relasi ke tabel Ulasan
    public function ulasan()
    {
        return $this->hasMany(Ulasan::class, 'id_barang')->where('status', 'terima');
    }
    public function averageRating()
    {
        return $this->ulasan->where('status', 'terima')->avg('jumlah_rating');
    }
}
