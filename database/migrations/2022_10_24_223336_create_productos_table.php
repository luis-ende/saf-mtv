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
            $table->string('clave_cabms', 10);
            $table->string('nombre');
            $table->text('descripcion');
            $table->string('tipo');
            $table->string('categoria')->nullable();
            $table->string('subcategoria')->nullable();
            $table->string('marca');
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
