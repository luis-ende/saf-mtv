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
        Schema::create('cat_categorias_scian', function (Blueprint $table) {
            $table->id();
            $table->string('categoria_scian');
            $table->string('scian');
            $table->string('palabras_clave_afines')->nullable();
            $table->foreignId('id_sector')->constrained('cat_sectores');
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
        Schema::dropIfExists('cat_categorias_scian');
    }
};
