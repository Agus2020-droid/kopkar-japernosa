<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePendaftaranTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pendaftaran', function (Blueprint $table) {
            $table->increments('id_pendaftaran');
            $table->string('nik_ktp', 16);
            $table->string('nama', 100);
            $table->string('email');
            $table->string('alamat', 255);
            $table->string('tmpt_lhr', 50);
            $table->string('tgl_lhr', 20);
            $table->string('telepon', 15);
            $table->string('tgl_masuk', 20);
            $table->string('nik_karyawan', 7);
            $table->string('status', 20);
            $table->string('file', 20);
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
        Schema::dropIfExists('pendaftaran');
    }
}
