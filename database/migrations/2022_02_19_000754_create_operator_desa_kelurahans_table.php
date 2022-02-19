<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOperatorDesaKelurahansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('operator_desa_kelurahans', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_desa_kelurahan')->nullable();
            $table->string('nip')->nullable();
            $table->string('nama_operator')->nullable();
            $table->string('jabatan')->nullable();
            $table->string('password')->nullable();
            $table->string('pangkat_golongan')->nullable();
            $table->string('foto')->default('foto.png');
            $table->string('aktif')->default('Y');
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
        Schema::dropIfExists('operator_desa_kelurahans');
    }
}
