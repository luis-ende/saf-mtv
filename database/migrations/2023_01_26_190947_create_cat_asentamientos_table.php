<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cat_asentamientos', function (Blueprint $table) {
            $table->id();
            $table->string('tipo_asentamiento', 30);
            $table->string('asentamiento', 70);
            $table->string('cp', 5);
            $table->integer('id_municipio');
            $table->string('municipio', 60);
            $table->integer('id_entidad');
            $table->string('entidad', 40);
            $table->integer('id_ciudad')->nullable();
            $table->string('ciudad', 50)->nullable();
            $table->string('zona', 15);
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
        Schema::dropIfExists('cat_asentamientos');
    }
};
