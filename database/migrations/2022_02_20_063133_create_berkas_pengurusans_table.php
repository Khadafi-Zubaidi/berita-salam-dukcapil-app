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
            $table->bigInteger('id_desa_kelurahan')->nullable();
            $table->string('nama_pemohon')->nullable();
            $table->string('alamat_pemohon')->nullable();
            $table->string('jenis_permohonan')->nullable();
            $table->string('berkas_permohonan')->nullable();
            $table->string('berkas_selesai')->nullable();
            $table->string('tanggal_pengajuan')->nullable();
            $table->string('tanggal_penyelesaian')->nullable();
            $table->string('bulan_pengajuan')->nullable();
            $table->string('status')->default('B');
            $table->text('isi_canting');
            $table->string('nomor_pendaftaran')->nullable();
            $table->text('dokumen_hasil');
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
