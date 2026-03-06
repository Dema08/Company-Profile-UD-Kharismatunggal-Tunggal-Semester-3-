<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class heroimage extends Model
{
    use HasFactory;
    protected $table = 'tb_heroimages';
    protected $primaryKey = 'id_heroimage';
    protected $fillable = ['image','tampilkandiabout'];
}
