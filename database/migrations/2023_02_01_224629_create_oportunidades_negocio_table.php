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
            $table->foreignId('id_unidad_compradora')->constraint('cat_unidades_compradoras');
            $table->text('nombre_procedimiento');
            $table->date('fecha_publicacion');
            $table->date('fecha_presentacion_propuestas')->nullable();
            $table->foreignId('id_tipo_contratacion')->constraint('cat_tipos_contratacion');
            $table->foreignId('id_metodo_contratacion')->constraint('cat_metodos_contratacion');
            $table->foreignId('id_etapa_procedimiento')->constraint('cat_etapas_procedimiento');
            $table->foreignId('id_estatus_contratacion')->constraint('cat_estatus_contratacion');
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
