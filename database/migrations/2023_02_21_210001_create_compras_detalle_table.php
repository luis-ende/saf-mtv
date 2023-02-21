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
        Schema::create('compras_detalle', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_calendario_compras')->constrained('calendario_compras');
            $table->string('objecto_contratacion', 255);
            $table->foreignId('id_tipo_contratacion')->constrained('cat_tipos_contratacion');
            $table->boolean('contratacion_mipymes')->default(false);
            $table->string('metodo_contr_proyectado', 255);
            $table->date('fecha_estimada_procedimiento');
            $table->date('fecha_estimada_inicio_contr');
            $table->date('fecha_estimada_fin_contr');
            $table->string('cabms', 255);
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
        Schema::dropIfExists('compras_detalle');
    }
};
