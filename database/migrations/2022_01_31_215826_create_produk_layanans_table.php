<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdukLayanansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produk_layanans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_produk_layanan')->nullable();
            $table->text('persyaratan')->nullable();
            $table->text('prosedur_mekanisme')->nullable();
            $table->text('waktu_penyelesaian')->nullable();
            $table->string('foto')->default('foto.png');
            $table->string('biaya_tarif')->nullable();
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
        Schema::dropIfExists('produk_layanans');
    }
}
