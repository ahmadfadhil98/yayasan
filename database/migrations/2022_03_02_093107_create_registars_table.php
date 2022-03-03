<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegistarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registars', function (Blueprint $table) {
            $table->id();
            $table->string('id_reg')->unique();
            $table->string('nama_pu');
            $table->string('nama_pu_alt');
            $table->string('no_daftar');
            $table->string('nama_jenis_daftar');
            $table->string('nama_jenis_produk');
            $table->string('nama_status_reg');
            $table->string('jml_produk');
            $table->string('nama_jenis_usaha');
            $table->string('nama_lph');
            $table->string('no_urut_ndpu');
            $table->string('no_ndpu');
            $table->string('jenis_daftar');
            $table->string('jenis_produk');

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
        Schema::dropIfExists('registars');
    }
}
