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
            $table->string('no_daftar');
            $table->string('nama_jenis_daftar');
            $table->string('nama_jenis_usaha');
            $table->string('status_reg');
            $table->integer('notif')->default(0);
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
