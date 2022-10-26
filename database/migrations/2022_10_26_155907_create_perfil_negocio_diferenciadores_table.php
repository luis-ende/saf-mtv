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
        Schema::create('perfil_negocio_diferenciadores', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_perfil_negocio')->constrained('perfil_negocio');
            $table->string('diferenciador', 50);
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
        Schema::dropIfExists('perfil_negocio_diferenciadores');
    }
};
