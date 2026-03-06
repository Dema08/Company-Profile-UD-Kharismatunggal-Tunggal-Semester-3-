<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengaturan extends Model
{
    use HasFactory;
    protected $table = 'tb_pengaturan';
    protected $primaryKey = 'id_pengaturan';
    protected $fillable = ['nama_toko', 'alamat_toko', 'no_hp_toko', 'koordinat_toko', 'logo_toko', 'linkshopee_toko'];
}
