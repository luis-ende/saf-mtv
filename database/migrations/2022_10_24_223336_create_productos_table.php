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
            $table->string('tipo');
            $table->string('clave_cabms', 10);
            $table->string('nombre');
            $table->string('descripcion', 140);
            $table->decimal('precio', 22, 2);
            // Si el tipo de producto es 'Bien'
            $table->string('marca')->nullable();
            $table->string('modelo')->nullable();
            $table->string('color', 30)->nullable();
            $table->string('material')->nullable();
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
