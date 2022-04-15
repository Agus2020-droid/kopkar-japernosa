<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnggotaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('anggota', function (Blueprint $table) {
            $table->id();
            $table->string('nik_anggota', 6);
            $table->string('nama_anggota', 100);
            $table->string('tempat_lahir', 20);
            $table->date('tgl_lahir');
            $table->string('status', 20);
            $table->string('alamat_anggota', 100);
            $table->string('telp', 13);
            $table->date('tgl_masuk');
            $table->string('divisi', 50);
            $table->string('bagian', 50);
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
        Schema::dropIfExists('anggota');
    }
}
