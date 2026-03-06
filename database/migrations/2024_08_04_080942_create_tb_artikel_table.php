<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('tb_artikel', function (Blueprint $table) {
            $table->id('id_artikel');
            $table->unsignedBigInteger('id_datapengguna');
            $table->string('judul');
            $table->text('deskripsi_singkat');
            $table->text('isi');
            $table->string('gambar')->nullable();
            $table->timestamps();

            $table->foreign('id_datapengguna')
                  ->references('id_datapengguna')
                  ->on('tb_datapengguna')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('tb_artikel');
    }
};
