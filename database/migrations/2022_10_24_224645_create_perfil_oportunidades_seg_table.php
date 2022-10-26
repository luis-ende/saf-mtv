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
        Schema::create('oportunidades_negocio_seguidores', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_oportunidad')->constrained('oportunidades_negocio');
            $table->foreignId('id_persona')->constrained('personas');
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
        Schema::dropIfExists('oportunidades_negocio_seguidores');
    }
};
