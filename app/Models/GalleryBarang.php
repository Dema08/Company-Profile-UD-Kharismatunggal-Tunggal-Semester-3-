<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GalleryBarang extends Model
{
    protected $table = 'gallery_barang';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_barang', 'path_gambar'
    ];

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'id_barang', 'id_barang');
    }
}
