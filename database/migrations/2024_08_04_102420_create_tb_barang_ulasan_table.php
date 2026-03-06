<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('tb_barang_ulasan', function (Blueprint $table) {
            $table->id('id_ulasan');
            $table->unsignedBigInteger('id_datapengguna')->nullable();
            $table->unsignedBigInteger('id_barang');
            $table->string('nama_pengguna')->nullable();
            $table->integer('jumlah_rating');
            $table->text('text');
            $table->enum('status',['pending','terima','tolak'])->default('pending');
            $table->timestamps();
            $table->foreign('id_datapengguna')->references('id_datapengguna')->on('tb_datapengguna')->onDelete('cascade');
            $table->foreign('id_barang')->references('id_barang')->on('tb_data_barang')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('tb_barang_ulasan');
    }
};
