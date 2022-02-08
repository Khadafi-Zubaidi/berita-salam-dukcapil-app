<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminAppsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_apps', function (Blueprint $table) {
            $table->id();
            $table->string('nip')->nullable();
            $table->string('nama')->nullable();
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
        Schema::dropIfExists('admin_apps');
    }
}
