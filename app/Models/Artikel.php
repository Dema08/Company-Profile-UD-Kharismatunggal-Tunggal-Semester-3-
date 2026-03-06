<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artikel extends Model
{
    use HasFactory;

    protected $table = 'tb_artikel';
    protected $primaryKey = 'id_artikel';

    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'id_datapengguna',
        'judul',
        'deskripsi_singkat',
        'isi',
        'gambar',
    ];

    /**
     * Get the tags associated with the article.
     */
    public function tags()
    {
        return $this->belongsToMany(TagArtikel::class, 'artikel_tag_artikel', 'id_artikel', 'id_tag_artikel');
    }
}
