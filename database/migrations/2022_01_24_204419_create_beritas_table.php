<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBeritasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('beritas', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_reporter')->nullable();
            $table->string('judul')->nullable();
            $table->string('tanggal_berita')->nullable();
            $table->text('isi_berita')->nullable();
            $table->string('foto')->default('newspaper.png');
            $table->string('diperiksa_oleh_redaktur')->default('B');
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
        Schema::dropIfExists('beritas');
    }
}
