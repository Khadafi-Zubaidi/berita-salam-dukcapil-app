<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBerkasPengurusansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('berkas_pengurusans', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_operator_desa_kelurahan')->nullable();
            $table->text('keterangan')->nullable();
            $table->string('berkas')->nullable();
            $table->string('tanggal_pengajuan')->nullable();
            $table->string('tanggal_penyelesaian')->nullable();
            $table->string('bulan_pengajuan')->nullable();
            $table->string('status')->default('B');
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
        Schema::dropIfExists('berkas_pengurusans');
    }
}
