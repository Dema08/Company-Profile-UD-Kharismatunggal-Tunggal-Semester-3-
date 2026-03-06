<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('tb_tag_artikel', function (Blueprint $table) {
            $table->id('id_tag_artikel');

            $table->string('nama_tag');
            $table->timestamps();



        });
    }

    public function down()
    {
        Schema::dropIfExists('tb_tag_artikel');
    }
};
