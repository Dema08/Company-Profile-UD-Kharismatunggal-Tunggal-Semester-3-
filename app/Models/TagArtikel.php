<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TagArtikel extends Model
{
    use HasFactory;

    protected $table = 'tb_tag_artikel';
    protected $primaryKey = 'id_tag_artikel';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'nama_tag',
    ];

    /**
     * Get the articles associated with the tag.
     */
    public function artikels()
    {
        return $this->belongsToMany(Artikel::class, 'artikel_tag_artikel', 'id_tag_artikel', 'id_artikel');
    }
}
