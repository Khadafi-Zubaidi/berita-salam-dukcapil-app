<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataAgregatSemesterDuasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_agregat_semester_duas', function (Blueprint $table) {
            $table->id();
            $table->text('judul')->nullable();
            $table->string('berkas')->default('contoh_berkas_pdf.pdf');
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
        Schema::dropIfExists('data_agregat_semester_duas');
    }
}
