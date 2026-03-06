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
        Schema::create('tb_datapengguna', function (Blueprint $table) {
            $table->id('id_datapengguna');
            $table->string('nama_pengguna');
            $table->string('email')->unique();
            $table->string('password');
            $table->text('alamat')->nullable();
            $table->bigInteger('no_telp')->nullable();
            $table->enum('role',['admin','user'])->default('user');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('datapenggunas');
    }
};
