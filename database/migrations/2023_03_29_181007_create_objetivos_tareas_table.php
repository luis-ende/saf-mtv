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
        Schema::create('objetivos_tareas', function (Blueprint $table) {
            $table->id();
            $table->string('objetivo', 255);
            $table->unsignedSmallInteger('tipo_objetivo')->nullable();
            $table->string('sugerencia', 255);
            $table->string('url_accion', 255)->nullable();
            $table->unsignedSmallInteger('objetivo_condicion')->nullable();
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
        Schema::dropIfExists('objetivos_tareas');
    }
};
