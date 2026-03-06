<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('tb_data_barang', function (Blueprint $table) {
            $table->id('id_barang');
            $table->string('nama_barang', 100);
            $table->text('deskripsi_singkat');
            $table->text('deskripsi');
            $table->decimal('harga_barang', 10, 2);
            $table->string('link_shopee', 225)->nullable();
            $table->enum('is_visible',['0','1'])->default(1);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tb_data_barang');
    }
};
