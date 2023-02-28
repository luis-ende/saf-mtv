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
        Schema::create('compras_procedimientos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_unidad_compradora')->constrained('cat_unidades_compradoras');
            $table->text('objeto_contratacion');
            $table->foreignId('id_tipo_contratacion')->constrained('cat_tipos_contratacion');
            $table->boolean('contratacion_mipymes')->default(false);
            $table->string('metodo_contr_proyectado', 255);
            $table->decimal('valor_estimado_contratacion', 12, 2);            
            $table->date('fecha_estimada_procedimiento');
            $table->date('fecha_estimada_inicio_contr');
            $table->date('fecha_estimada_fin_contr');
            $table->timestamps();

            $table->index('id_unidad_compradora');
            $table->index(['id_unidad_compradora', 'objeto_contratacion']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('compras_procedimientos');
    }
};
