<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMataPelajaranMahasiswaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mata_pelajaran_mahasiswa', function (Blueprint $table) {
            $table->bigIncrements('id_mata_pelajaran_mahasiswa');
            $table->integer('id_user')->unsigned();
            $table->foreign('id_user')->references('id_user')->on('mahasiswa');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mata_pelajaran_mahasiswa');
    }
}
