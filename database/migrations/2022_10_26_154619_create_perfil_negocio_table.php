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
        Schema::create('perfil_negocio', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_persona')->constrained('personas');
            $table->unsignedInteger('id_grupo_prioritario');
            $table->unsignedInteger('id_tipo_pyme')->nullable();
            $table->unsignedInteger('id_sector')->nullable();
            $table->unsignedInteger('id_categoria_scian')->nullable();
            $table->text('lema_negocio')->nullable();
            $table->text('descripcion_negocio')->nullable();
            $table->text('diferenciadores')->nullable();
            $table->string('sitio_web', 255)->nullable();
            $table->string('cuenta_facebook', 240)->nullable();
            $table->string('cuenta_twitter', 240)->nullable();
            $table->string('cuenta_linkedin', 240)->nullable();
            $table->string('num_whatsapp', 15)->nullable();
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
        Schema::dropIfExists('perfil_negocio');
    }
};
