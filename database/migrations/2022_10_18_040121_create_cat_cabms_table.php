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
        Schema::create('cat_cabms', function (Blueprint $table) {
            $table->id();
            $table->string('cabms');
            $table->string('nombre_cabms');
            $table->string('partida');
            $table->foreignId('id_categoria_scian')->constrained('cat_categorias_scian');
            $table->timestamps();
            
            $table->index('nombre_cabms');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cat_cabms');
    }
};
