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
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_cat_productos')->constrained('cat_productos');
            $table->char('tipo', 1); // 'B' = 'Bien', 'S' = 'Servicio'
            $table->unsignedBigInteger('id_cabms')->nullable();
            $table->string('ids_categorias');
            $table->string('nombre', 255);
            $table->string('descripcion', 140);
            // Si el tipo de producto es 'Bien'
            $table->string('marca')->nullable();
            $table->string('modelo')->nullable();
            $table->string('color', 30)->nullable();
            $table->string('material')->nullable();
            $table->string('codigo_barras', 100)->nullable();
            $table->unsignedSmallInteger('registro_fase')->default(1);
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
        Schema::dropIfExists('productos');
    }
};
