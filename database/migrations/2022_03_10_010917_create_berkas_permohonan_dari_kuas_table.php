<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBerkasPermohonanDariKuasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('berkas_permohonan_dari_kuas', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_operator_kua')->nullable();
            $table->bigInteger('id_kua')->nullable();
            $table->string('nik_pemohon')->nullable();
            $table->string('nama_pemohon')->nullable();
            $table->string('alamat_pemohon')->nullable();
            $table->string('jenis_permohonan')->nullable();
            $table->string('berkas_permohonan')->nullable();
            $table->string('berkas_selesai')->nullable();
            $table->string('tanggal_pengajuan')->nullable();
            $table->string('tanggal_penyelesaian')->nullable();
            $table->string('bulan_pengajuan')->nullable();
            $table->string('tahun_pengajuan')->nullable();
            $table->string('status')->default('B');
            $table->text('isi_canting')->nullable();
            $table->string('nomor_pendaftaran')->nullable();
            $table->text('dokumen_hasil')->nullable();
            $table->integer('jml_kk')->default(0);
            $table->integer('jml_skp')->default(0);
            $table->integer('jml_kia')->default(0);
            $table->integer('jml_akta_kelahiran')->default(0);
            $table->integer('jml_akta_kematian')->default(0);
            $table->integer('jml_lain_lain')->default(0);
            $table->string('nama_kua')->nullable();
            $table->string('nama_kecamatan')->nullable();
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
        Schema::dropIfExists('berkas_permohonan_dari_kuas');
    }
}
