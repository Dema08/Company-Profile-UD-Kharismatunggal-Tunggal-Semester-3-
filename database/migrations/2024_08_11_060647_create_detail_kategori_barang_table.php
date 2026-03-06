<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_detail_kategori_barang', function (Blueprint $table) {
            $table->id('id_detail_kategori_barang'); // Primary key
            $table->unsignedBigInteger('id_kategori_barang'); // Foreign key
            $table->unsignedBigInteger('id_barang'); // Foreign key
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('id_kategori_barang')->references('id_kategori_barang')->on('tb_kategori_barang')->onDelete('cascade');
            $table->foreign('id_barang')->references('id_barang')->on('tb_data_barang')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_detail_kategori_barang');
    }
};
