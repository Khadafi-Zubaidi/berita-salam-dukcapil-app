<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOperatorFasilitasKesehatansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('operator_fasilitas_kesehatans', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_fasilitas_kesehatan')->nullable();
            $table->string('id_operator_fasilitas_kesehatan')->nullable();
            $table->string('nama_operator')->nullable();
            $table->string('password')->nullable();
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
        Schema::dropIfExists('operator_fasilitas_kesehatans');
    }
}
