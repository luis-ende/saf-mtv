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
        Schema::create('oportunidades_negocio', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_procedimiento');            
            $table->date('fecha_publicacion');
            $table->string('tipo_contratacion', 100);
            $table->string('metodo_contratacion', 60);
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
        Schema::dropIfExists('oportunidades_negocio');
    }
};
