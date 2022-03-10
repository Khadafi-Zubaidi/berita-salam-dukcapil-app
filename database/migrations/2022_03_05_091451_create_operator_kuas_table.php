<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOperatorKuasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('operator_kuas', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_kua')->nullable();
            $table->string('id_operator_kua')->nullable();
            $table->string('nama_operator')->nullable();
            $table->string('no_wa')->nullable();
            $table->string('password')->nullable();
            $table->string('foto')->default('foto.png');
            $table->string('berkas')->default('berkas.zip');
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
        Schema::dropIfExists('operator_kuas');
    }
}
