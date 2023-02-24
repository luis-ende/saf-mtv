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
        Schema::create('calendario_compras', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_unidad_compradora')->constrained('cat_unidades_compradoras');            
            $table->decimal('presup_contratacion_aprobado', 12, 2);
            $table->unsignedSmallInteger('total_procedimientos');
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
        Schema::dropIfExists('calendario_compras');
    }
};
