<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FAQ extends Model
{
    use HasFactory;

    protected $table = 'tb_faq'; 

    protected $primaryKey = 'id_faq';

    protected $fillable = [
        'pertanyaan',
        'jawaban',
    ];
}
