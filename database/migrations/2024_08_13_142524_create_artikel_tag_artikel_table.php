<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('artikel_tag_artikel', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_artikel');
            $table->unsignedBigInteger('id_tag_artikel');
            $table->timestamps();

            $table->foreign('id_artikel')
                  ->references('id_artikel')
                  ->on('tb_artikel')
                  ->onDelete('cascade');

            $table->foreign('id_tag_artikel')
                  ->references('id_tag_artikel')
                  ->on('tb_tag_artikel')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('artikel_tag_artikel');
    }
};

